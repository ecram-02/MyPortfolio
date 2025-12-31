<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            // Check if column exists before adding
            if (!Schema::hasColumn('settings', 'about_summary')) {
                $table->text('about_summary')->nullable()->after('contact_email');
            }
            
            if (!Schema::hasColumn('settings', 'phone')) {
                $table->string('phone')->nullable()->after('about_summary');
            }
            
            if (!Schema::hasColumn('settings', 'resume_url')) {
                $table->string('resume_url')->nullable()->after('phone');
            }
            
            if (!Schema::hasColumn('settings', 'linkedin_url')) {
                $table->string('linkedin_url')->nullable()->after('resume_url');
            }
            
            if (!Schema::hasColumn('settings', 'github_url')) {
                $table->string('github_url')->nullable()->after('linkedin_url');
            }
            
            if (!Schema::hasColumn('settings', 'twitter_url')) {
                $table->string('twitter_url')->nullable()->after('github_url');
            }
            
            if (!Schema::hasColumn('settings', 'site_logo')) {
                $table->string('site_logo')->nullable()->after('twitter_url');
            }
            
            if (!Schema::hasColumn('settings', 'dark_mode')) {
                $table->boolean('dark_mode')->default(false)->after('site_logo');
            }
        });
    }

    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            // Only drop columns if they exist
            $columns = ['about_summary', 'phone', 'resume_url', 'linkedin_url', 'github_url', 'twitter_url', 'site_logo', 'dark_mode'];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('settings', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};