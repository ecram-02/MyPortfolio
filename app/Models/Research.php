<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Research extends Model
{
   use HasFactory;

    // Remove or comment out the explicit table name since Laravel will now use 'researches'
    // protected $table = 'research'; // Remove this line
    
    // Or if you want to be explicit:
    protected $table = 'researches'; // Add this line


    protected $fillable = [
        'title', 'slug', 'category', 'type', 'start_date', 'end_date', 'description'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // Automatically generate slug when creating/updating research
    protected static function booted()
    {
        static::creating(function ($research) {
            $research->slug = \Str::slug($research->title);
        });

        static::updating(function ($research) {
            $research->slug = \Str::slug($research->title);
        });
    }
}
