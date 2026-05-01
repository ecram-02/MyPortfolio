<?php
// app/Http/Controllers/ResearchController.php

namespace App\Http\Controllers;

use App\Models\Research;
use App\Models\ResearchPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResearchController extends Controller
{
    private $allowedTypes = ['research', 'experiment', 'case_study', 'thesis', 'paper'];

    public function index()
    {
        $researches = Research::with('featuredPhoto')->latest()->paginate(10);
        // Fix: Changed from 'admin.researches.index' to 'researches.index'
        return view('researches.index', compact('researches'));
    }

    public function show($slug)
    {
        $research = Research::with('photos')->where('slug', $slug)->firstOrFail();
        return view('researches.show', compact('research'));
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
            'photos' => 'nullable|array',
            'photos.*' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:5120',
            'captions' => 'nullable|array',
        ]);

        $research = Research::create([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'type' => $request->type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        // Handle photo uploads
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $photo) {
                $path = $photo->store('research/photos', 'public');
                
                ResearchPhoto::create([
                    'research_id' => $research->id,
                    'image' => $path,
                    'caption' => $request->captions[$index] ?? null,
                    'is_featured' => $index === 0,
                    'position' => $index,
                ]);
            }
        }

        return redirect()->route('researches.index')
            ->with('success', 'Research added successfully.');
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
            'photos' => 'nullable|array',
            'photos.*' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:5120',
            'captions' => 'nullable|array',
            'delete_photos' => 'nullable|array',
            'delete_photos.*' => 'exists:research_photos,id',
            'featured_photo_id' => 'nullable|exists:research_photos,id',
        ]);

        $research->update([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'type' => $request->type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        // Delete selected photos
        if ($request->has('delete_photos')) {
            foreach ($request->delete_photos as $photoId) {
                $photo = ResearchPhoto::find($photoId);
                if ($photo && $photo->research_id === $research->id) {
                    $photo->delete();
                }
            }
        }

        // Update featured photo
        if ($request->has('featured_photo_id') && $request->featured_photo_id) {
            ResearchPhoto::where('research_id', $research->id)->update(['is_featured' => false]);
            
            $featuredPhoto = ResearchPhoto::find($request->featured_photo_id);
            if ($featuredPhoto && $featuredPhoto->research_id === $research->id) {
                $featuredPhoto->update(['is_featured' => true]);
            }
        }

        // Handle new photo uploads
        if ($request->hasFile('photos')) {
            $currentMaxPosition = $research->photos()->max('position') ?? -1;
            
            foreach ($request->file('photos') as $index => $photo) {
                $path = $photo->store('research/photos', 'public');
                $newPosition = $currentMaxPosition + $index + 1;
                
                ResearchPhoto::create([
                    'research_id' => $research->id,
                    'image' => $path,
                    'caption' => $request->captions[$index] ?? null,
                    'is_featured' => $research->photos()->count() === 0,
                    'position' => $newPosition,
                ]);
            }
        }

        return redirect()->route('researches.index')
            ->with('success', 'Research updated successfully.');
    }

    public function destroy(Research $research)
    {
        $research->delete();
        return redirect()->route('researches.index')
            ->with('success', 'Research deleted successfully.');
    }
}