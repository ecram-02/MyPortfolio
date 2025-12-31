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
    if (!Schema::hasColumn('articles', 'excerpt')) {
        Schema::table('articles', function (Blueprint $table) {
            $table->text('excerpt')->nullable()->after('slug');
        });
    }
}

public function down()
{
    if (Schema::hasColumn('articles', 'excerpt')) {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('excerpt');
        });
    }
}
};
