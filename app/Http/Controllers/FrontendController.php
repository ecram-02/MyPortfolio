<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\Article;
use App\Models\Project;
use App\Models\Research;
use App\Models\Publication;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        // Get all skills grouped by category
        $skills = Skill::all()->groupBy('category');
        
        // Get latest articles (limit to 5 for frontend)
        $articles = Article::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // Get latest research (limit to 5)
        $researches = Research::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // Get latest projects (limit to 6)
        $projects = Project::orderBy('created_at', 'desc')
            ->limit(6)
            ->get();
        
        // Get latest publications
        $publications = Publication::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('frontend.index', compact(
            'skills',
            'articles',
            'researches',
            'projects',
            'publications'
        ));
    }

    public function showArticle($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        return view('frontend.article', compact('article'));
    }

    public function showProject($id)
    {
        $project = Project::findOrFail($id);
        return view('frontend.project', compact('project'));
    }
}