<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('monthly', function (Blueprint $table) {
            $table->decimal('total_monthly', 10, 2)->default(0); // Add new column
        });
    }
    
    public function down()
    {
        Schema::table('monthly', function (Blueprint $table) {
            $table->dropColumn('total_monthly');
        });
    }
    
};
