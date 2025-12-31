<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        if (Schema::hasTable('research') && !Schema::hasTable('researches')) {
            Schema::rename('research', 'researches');
        }
    }

    public function down()
    {
        if (Schema::hasTable('researches') && !Schema::hasTable('research')) {
            Schema::rename('researches', 'research');
        }
    }
};