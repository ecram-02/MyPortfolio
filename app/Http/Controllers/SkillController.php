<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::latest()->paginate(10);
        return view('skills.index', compact('skills'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'proficiency' => 'required|integer|min:0|max:100',
        ]);

        Skill::create([
            'name' => $request->name,
            'category' => $request->category,
            'proficiency' => $request->proficiency,
        ]);

        return redirect()->route('skills.index')->with('success', 'Skill added successfully!');
    }

    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'proficiency' => 'required|integer|min:0|max:100',
        ]);

        $skill->update([
            'name' => $request->name,
            'category' => $request->category,
            'proficiency' => $request->proficiency,
        ]);

        return redirect()->route('skills.index')->with('success', 'Skill updated successfully!');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('skills.index')->with('success', 'Skill deleted successfully!');
    }

    public function dashboard()
    {
        $skillsCount = Skill::count();
        $articlesCount = \App\Models\Article::count();
        $publicationsCount = \App\Models\Publication::count();
        $projectsCount = \App\Models\Project::count();

        return view('dashboard', compact(
            'skillsCount',
            'articlesCount',
            'publicationsCount',
            'projectsCount'
        ));
    }
}