<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Project;
use App\Models\Publication;
use App\Models\Research;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function globalSearch(Request $request)
    {
        $query = $request->input('query');
        
        if (empty($query)) {
            return response()->json(['results' => []]);
        }

        $user = Auth::user();
        $results = [];

        // Search in Articles
        $articles = Article::where('title', 'LIKE', "%{$query}%")
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->limit(5)
            ->get()
            ->map(function($article) {
                return [
                    'id' => $article->id,
                    'title' => $article->title,
                    'type' => 'article',
                    'url' => route('articles.index'),
                    'icon' => 'fas fa-newspaper',
                    'description' => substr(strip_tags($article->content), 0, 100) . '...'
                ];
            });

        // Search in Projects
        $projects = Project::where('title', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->limit(5)
            ->get()
            ->map(function($project) {
                return [
                    'id' => $project->id,
                    'title' => $project->title,
                    'type' => 'project',
                    'url' => route('projects.index'),
                    'icon' => 'fas fa-project-diagram',
                    'description' => substr($project->description, 0, 100) . '...'
                ];
            });

        // Search in Publications
        $publications = Publication::where('title', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->limit(5)
            ->get()
            ->map(function($publication) {
                return [
                    'id' => $publication->id,
                    'title' => $publication->title,
                    'type' => 'publication',
                    'url' => route('publications.index'),
                    'icon' => 'fas fa-book',
                    'description' => substr($publication->description, 0, 100) . '...'
                ];
            });

        // Search in Users (for messaging)
        $users = User::where('name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->where('id', '!=', $user->id)
            ->limit(5)
            ->get()
            ->map(function($user) {
                return [
                    'id' => $user->id,
                    'title' => $user->name . ' (' . $user->email . ')',
                    'type' => 'user',
                    'url' => '#',
                    'icon' => 'fas fa-user',
                    'description' => 'Click to send message'
                ];
            });

        // Merge all results
        $results = array_merge(
            $articles->toArray(),
            $projects->toArray(),
            $publications->toArray(),
            $users->toArray()
        );

        // Sort by relevance (simplified)
        usort($results, function($a, $b) use ($query) {
            $aScore = stripos($a['title'], $query) !== false ? 1 : 0;
            $bScore = stripos($b['title'], $query) !== false ? 1 : 0;
            return $bScore - $aScore;
        });

        return response()->json([
            'query' => $query,
            'results' => $results,
            'total' => count($results)
        ]);
    }
}