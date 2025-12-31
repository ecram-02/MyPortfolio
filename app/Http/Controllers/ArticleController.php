<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()
            ->paginate(12);
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category' => 'nullable|string|max:100',
            'status' => 'required|string|in:draft,published,scheduled',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $data = $request->only(['title', 'excerpt', 'content', 'category', 'status', 'published_at']);
        
        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('articles/featured', 'public');
            $data['featured_image'] = $path;
        }

        // Set published_at if status is published and not already set
        if ($request->status == 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        Article::create($data);

        return redirect()->route('articles.index')
            ->with('success', 'Article created successfully.');
    }

    public function show(Article $article)
    {
        // Increment views
        $article->increment('views');
        
        // Get related articles (same category)
        $relatedArticles = Article::where('category', $article->category)
            ->where('id', '!=', $article->id)
            ->where('status', 'published')
            ->latest()
            ->take(3)
            ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }

    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category' => 'nullable|string|max:100',
            'status' => 'required|string|in:draft,published,scheduled',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $data = $request->only(['title', 'excerpt', 'content', 'category', 'status', 'published_at']);
        
        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($article->featured_image && Storage::disk('public')->exists($article->featured_image)) {
                Storage::disk('public')->delete($article->featured_image);
            }
            
            $path = $request->file('featured_image')->store('articles/featured', 'public');
            $data['featured_image'] = $path;
        }

        // Set published_at if status changed to published and not already set
        if ($request->status == 'published' && $article->status != 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $article->update($data);

        return redirect()->route('articles.index')
            ->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article)
    {
        // Delete featured image if exists
        if ($article->featured_image && Storage::disk('public')->exists($article->featured_image)) {
            Storage::disk('public')->delete($article->featured_image);
        }
        
        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', 'Article deleted successfully.');
    }

    // Method to handle image uploads within content (for rich text editor)
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $path = $request->file('image')->store('articles/content', 'public');
        
        return response()->json([
            'url' => asset('storage/' . $path)
        ]);
    }
}