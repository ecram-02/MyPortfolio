<?php
// database/migrations/2024_01_01_000002_create_research_photos_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('research_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('research_id')
                ->constrained('researches')
                ->onDelete('cascade');
            $table->string('image');
            $table->string('caption')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('position')->default(0);
            $table->timestamps();
            
            // Add index for faster queries
            $table->index(['research_id', 'position']);
            $table->index('is_featured');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('research_photos');
    }
};