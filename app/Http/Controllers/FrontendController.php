<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\Article;
use App\Models\Project;
use App\Models\Research;

class FrontendController extends Controller
{
    public function about()
    {
        $settings = Setting::first();
        $skills = Skill::orderBy('proficiency', 'desc')->get();
        
        return view('frontend.about', compact('settings', 'skills'));
    }

    public function research()
    {
        $settings = Setting::first();
        $researches = Research::latest()->get();
        
        return view('frontend.research', compact('settings', 'researches'));
    }

   public function articles()
{
    $settings = Setting::first();
    
    // Paginated articles only
    $articles = Article::published()
        ->latest()
        ->paginate(6);

    return view('frontend.articles', compact('settings', 'articles'));
}


    public function projects()
    {
        $settings = Setting::first();
        $projects = Project::latest()->get();
        
        return view('frontend.projects', compact('settings', 'projects'));
    }

    public function contact()
    {
        $settings = Setting::first();
        
        return view('frontend.contact', compact('settings'));
    }
    
    // Optional: Add a method to show all articles with pagination
    public function allArticles()
    {
        $settings = Setting::first();
        $articles = Article::published()
            ->latest()
            ->paginate(12);
        
        return view('frontend.all-articles', compact('settings', 'articles'));
    }

    // Show single article for public - FIXED: Using slug parameter
    public function showArticle($slug)
    {
        $settings = Setting::first();
        
        // Find article by slug
        $article = Article::where('slug', $slug)->firstOrFail();
        
        // Only show published articles to public
        if ($article->status !== 'published') {
            abort(404, 'Article not found or not published yet.');
        }
        
        // Check if published_at is in the future
        if ($article->published_at && $article->published_at->isFuture()) {
            abort(404, 'Article is scheduled for future publication.');
        }
        
        // Increment views
        $article->increment('views');
        
        // Get related articles
        $relatedArticles = Article::where('category', $article->category)
            ->where('id', '!=', $article->id)
            ->where('status', 'published')
            ->latest()
            ->take(3)
            ->get();
        
        return view('frontend.article-show', compact('settings', 'article', 'relatedArticles'));
    }

    public function showProject($slug)
{
    $settings = Setting::first();
    
    // Find project by slug
    $project = Project::where('slug', $slug)->firstOrFail();
    
    // Get related projects (based on same language)
    $relatedProjects = Project::where('language', $project->language)
        ->where('id', '!=', $project->id)
        ->latest()
        ->take(3)
        ->get();
    
    return view('frontend.project-show', compact('settings', 'project', 'relatedProjects'));
}

public function showResearch($slug)
{
    $settings = Setting::first();

    $research = Research::where('slug', $slug)->firstOrFail();

    return view('frontend.research-show', compact('settings', 'research'));
}

}