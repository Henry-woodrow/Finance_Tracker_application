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
        Schema::create('goals', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->string('goal_name'); // Name of the goal
            $table->decimal('goal_amount', 10, 2); // Total goal amount
            $table->decimal('current_amount', 10, 2)->default(0); // Current saved amount
            $table->decimal('target_amount', 10, 2); // Target amount
            $table->date('due_date')->nullable(); // Due date (nullable)
            $table->timestamps(); // Created at and updated at timestamps

            // Add a foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goal');
    }
};
