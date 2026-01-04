<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->paginate(10);
        return view('projects.index', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'language' => 'nullable|string|max:255',
            'description' => 'required|string',
            'repository_link' => 'nullable|url|max:255',
            'status' => 'required|string|in:Ongoing,Completed,Pending',
        ]);

        Project::create([
            'title' => $request->title,
            // ✅ SLUG GENERATED HERE (FRONTEND USE ONLY)
            'slug' => Str::slug($request->title),

            'language' => $request->language,
            'description' => $request->description,
            'repository_link' => $request->repository_link,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project added successfully.');
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'language' => 'nullable|string|max:255',
            'description' => 'required|string',
            'repository_link' => 'nullable|url|max:255',
            'status' => 'required|string|in:Ongoing,Completed,Pending',
        ]);

        $project->update([
            'title' => $request->title,
            // ✅ UPDATE SLUG IF TITLE CHANGES
            'slug' => Str::slug($request->title),

            'language' => $request->language,
            'description' => $request->description,
            'repository_link' => $request->repository_link,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}
