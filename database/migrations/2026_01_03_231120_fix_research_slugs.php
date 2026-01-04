<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up()
    {
        // First, generate slugs for all researches with empty slugs
        $researches = DB::table('researches')->get();
        
        foreach ($researches as $research) {
            if (empty($research->slug) || $research->slug === '') {
                $slug = Str::slug($research->title);
                
                // Make slug unique
                $counter = 1;
                $originalSlug = $slug;
                
                while (DB::table('researches')->where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
                
                DB::table('researches')
                    ->where('id', $research->id)
                    ->update(['slug' => $slug]);
            }
        }
    }

    public function down()
    {
        // Optional: You can revert empty strings if needed
        DB::table('researches')->where('slug', 'like', '%-%')->update(['slug' => '']);
    }
};