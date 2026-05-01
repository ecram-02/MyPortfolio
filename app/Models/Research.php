<?php
// app/Models/Research.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    use HasFactory;

    protected $table = 'researches';

    protected $fillable = [
        'title', 'slug', 'category', 'type', 'start_date', 'end_date', 'description'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // Relationships for photos
    public function photos()
    {
        return $this->hasMany(ResearchPhoto::class)->orderBy('position', 'asc');
    }

    public function featuredPhoto()
    {
        return $this->hasOne(ResearchPhoto::class)->where('is_featured', true);
    }

    // Get gallery photos (exclude featured)
    public function galleryPhotos()
    {
        return $this->hasMany(ResearchPhoto::class)
            ->where('is_featured', false)
            ->orderBy('position', 'asc');
    }

    // Automatically generate slug when creating/updating research
    protected static function booted()
    {
        static::creating(function ($research) {
            $research->slug = \Str::slug($research->title);
        });

        static::updating(function ($research) {
            $research->slug = \Str::slug($research->title);
        });
        
        // Cascade delete photos when research is deleted
        static::deleting(function ($research) {
            $research->photos()->delete();
        });
    }
}