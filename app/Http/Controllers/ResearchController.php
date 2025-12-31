<?php

namespace App\Http\Controllers;

use App\Models\Research;
use Illuminate\Http\Request;

class ResearchController extends Controller
{
    // Define allowed types for validation
    private $allowedTypes = ['research', 'experiment', 'case_study', 'thesis', 'paper'];

    public function index()
    {
        $researches = Research::latest()->paginate(10);
        return view('researches.index', compact('researches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string|in:' . implode(',', $this->allowedTypes),
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        Research::create([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'type' => $request->type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('researches.index')->with('success', 'Research added successfully.');
    }

    public function update(Request $request, Research $research)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string|in:' . implode(',', $this->allowedTypes),
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $research->update([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'type' => $request->type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('researches.index')->with('success', 'Research updated successfully.');
    }

    public function destroy(Research $research)
    {
        $research->delete();
        return redirect()->route('researches.index')->with('success', 'Research deleted successfully.');
    }
}