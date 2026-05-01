<?php
// app/Models/ResearchPhoto.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ResearchPhoto extends Model
{
    protected $fillable = [
        'research_id',
        'image',
        'caption',
        'is_featured',
        'position'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'position' => 'integer'
    ];

    public function research()
    {
        return $this->belongsTo(Research::class);
    }

    // Helper method to get full image URL
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    // Delete image from storage when model is deleted
    protected static function booted()
    {
        static::deleting(function ($photo) {
            if ($photo->image && Storage::disk('public')->exists($photo->image)) {
                Storage::disk('public')->delete($photo->image);
            }
        });
    }
}