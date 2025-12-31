<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\Article;
use App\Models\Publication;
use App\Models\Research;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        // Get counts for portfolio dashboard
        $skillsCount = Skill::count();
        $articlesCount = Article::count();
        $publicationsCount = Publication::count();
        $researchesCount = Research::count();
        $projectsCount = Project::count();
        
        // Get recent items for dashboard
        $recentArticles = Article::latest()->take(5)->get();
        $recentProjects = Project::latest()->take(5)->get();
        $recentResearches = Research::latest()->take(5)->get();

        return view('dashboard', compact(
            'skillsCount',
            'articlesCount',
            'publicationsCount',
            'researchesCount',
            'projectsCount',
            'recentArticles',
            'recentProjects',
            'recentResearches'
        ));
    }
}