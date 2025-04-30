<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('weekly', function (Blueprint $table) {
            $table->decimal('weekly_total', 10, 2)->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('weekly', function (Blueprint $table) {
            $table->dropColumn('weekly_total');
        });
    }
};
