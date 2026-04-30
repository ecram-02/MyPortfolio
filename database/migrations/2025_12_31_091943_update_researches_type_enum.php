<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('researches', function (Blueprint $table) {
            // Using string() is the SQLite-compatible way to "change" an enum
            $table->string('type')->default('research')->change();
        });
    }

    public function down()
    {
        Schema::table('researches', function (Blueprint $table) {
            $table->string('type')->default('research')->change();
        });
    }
};
