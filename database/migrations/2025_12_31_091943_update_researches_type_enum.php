<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Update the enum to include all types you want
        DB::statement("ALTER TABLE researches MODIFY COLUMN type ENUM('research', 'experiment', 'case_study', 'thesis', 'paper') DEFAULT 'research'");
    }

    public function down()
    {
        // Revert back to original enum if needed
        DB::statement("ALTER TABLE researches MODIFY COLUMN type ENUM('experiment','research') DEFAULT 'research'");
    }
};