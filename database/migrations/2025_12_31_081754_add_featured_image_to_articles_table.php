<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    if (!Schema::hasColumn('articles', 'featured_image')) {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('featured_image')->nullable()->after('category');
        });
    }
}

public function down()
{
    if (Schema::hasColumn('articles', 'featured_image')) {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('featured_image');
        });
    }
}
};
