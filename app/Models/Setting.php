<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',          // Portfolio name (Ecram Mnthali)
        'site_logo',          // Logo image
        'contact_email',      // Primary contact email
        'phone',              // Phone number
        'address',            // Optional address
        'linkedin_url',       // LinkedIn profile
        'github_url',         // GitHub profile
        'twitter_url',        // Twitter profile
        'resume_url',         // Resume/CV download link
        'about_summary',      // Short bio/about text
        'dark_mode',          // Theme setting
    ];
}