<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'category',
        'status',
        'featured_image',
        'views',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Automatically generate slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = \Str::slug($article->title);
            }
        });

        static::updating(function ($article) {
            if ($article->isDirty('title')) {
                $article->slug = \Str::slug($article->title);
            }
        });
    }

    // Get featured image URL
    public function getFeaturedImageUrlAttribute()
    {
        if ($this->featured_image) {
            // Check if it's a full URL or storage path
            if (filter_var($this->featured_image, FILTER_VALIDATE_URL)) {
                return $this->featured_image;
            }
            return asset('storage/' . $this->featured_image);
        }
        // Return a nice placeholder
        return 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=1200&h=630&fit=crop';
    }

    // Get reading time
    public function getReadingTimeAttribute()
    {
        $words = str_word_count(strip_tags($this->content));
        $minutes = ceil($words / 200);
        return $minutes . ' min read';
    }

    // Get author name (you!)
    public function getAuthorAttribute()
    {
        return 'Ecram Mnthali'; // Or get from auth user if needed
    }

    // Scope for published articles
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->where(function ($q) {
                        $q->whereNull('published_at')
                          ->orWhere('published_at', '<=', now());
                    });
    }

    // Scope for draft articles
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    // Scope for scheduled articles
    public function scopeScheduled($query)
    {
        return $query->where('status', 'scheduled')
                    ->where('published_at', '>', now());
    }
}