<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // First, make sure slug column exists
        if (!Schema::hasColumn('researches', 'slug')) {
            Schema::table('researches', function (Blueprint $table) {
                $table->string('slug')->after('title');
            });
        }
        
        // Add unique constraint
        Schema::table('researches', function (Blueprint $table) {
            $table->string('slug')->unique()->change();
        });
    }

    public function down()
    {
        Schema::table('researches', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->string('slug')->nullable()->change();
        });
    }
};