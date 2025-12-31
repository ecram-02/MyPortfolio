<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('researches', function (Blueprint $table) {
            // Add category field
            $table->string('category')->nullable()->after('title');
            
            // Make sure we have the right table name (singular vs plural)
            if (!Schema::hasColumn('researches', 'description')) {
                $table->text('description')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('researches', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }
};