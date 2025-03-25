<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('salary', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->index();
            $table->decimal('Pretax amount', 15, 2)->default(100);
            $table->decimal('posttax amount', 15, 3)->default(1000);
            $table->timestamps();
        });
    }


};
