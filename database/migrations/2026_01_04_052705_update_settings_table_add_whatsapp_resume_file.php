<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            // Remove twitter_url column
            $table->dropColumn('twitter_url');
            
            // Remove resume_url column
            $table->dropColumn('resume_url');
            
            // Add whatsapp_number column
            $table->string('whatsapp_number')->nullable()->after('github_url');
            
            // Add resume_file column for file uploads
            $table->string('resume_file')->nullable()->after('whatsapp_number');
        });
    }

    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('twitter_url')->nullable();
            $table->string('resume_url')->nullable();
            $table->dropColumn(['whatsapp_number', 'resume_file']);
        });
    }
};