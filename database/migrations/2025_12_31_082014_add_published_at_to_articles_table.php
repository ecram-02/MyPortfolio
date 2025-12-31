<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            // Add published_at after featured_image instead of author_id
            if (!Schema::hasColumn('articles', 'published_at')) {
                $table->timestamp('published_at')->nullable()->after('featured_image');
            }
        });
    }

    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            if (Schema::hasColumn('articles', 'published_at')) {
                $table->dropColumn('published_at');
            }
        });
    }
};