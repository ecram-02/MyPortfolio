<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function index()
    {
        $publications = Publication::latest()->paginate(10);
        return view('publications.index', compact('publications'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_at' => 'required|date',
        ]);

        Publication::create($request->only('title','author','published_at'));

        return redirect()->route('publications.index')->with('success', 'Publication added successfully.');
    }

    public function update(Request $request, $id)
    {
        $publication = Publication::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_at' => 'required|date',
        ]);

        $publication->update($request->only('title','author','published_at'));

        return redirect()->route('publications.index')->with('success', 'Publication updated successfully.');
    }

    public function destroy($id)
    {
        $publication = Publication::findOrFail($id);
        $publication->delete();

        return redirect()->route('publications.index')->with('success', 'Publication deleted successfully.');
    }
}
