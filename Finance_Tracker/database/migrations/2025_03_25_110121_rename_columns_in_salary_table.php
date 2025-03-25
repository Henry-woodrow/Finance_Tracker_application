<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('salary', function (Blueprint $table) {
            $table->renameColumn('Pretax amount', 'pretax_amount');
            $table->renameColumn('posttax amount', 'posttax_amount');
        });
    }

    public function down(): void
    {
        Schema::table('salary', function (Blueprint $table) {
            $table->renameColumn('pretax_amount', 'Pretax amount');
            $table->renameColumn('posttax_amount', 'posttax amount');
        });
    }
};
