<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Add status field
            $table->enum('status', ['Ongoing', 'Completed', 'Pending'])
                  ->default('Pending')
                  ->after('title');
            
            // Make language nullable if not already
            $table->string('language')->nullable()->change();
            
            // Add link field if you want to keep repository_link
            // Already exists, but let's make sure it's nullable
            $table->string('repository_link')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('status');
            // Revert changes if needed
            $table->string('language')->nullable(false)->change();
        });
    }
};