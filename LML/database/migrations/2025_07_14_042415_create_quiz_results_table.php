<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quiz_results', function (Blueprint $table) {
            $table->id(); // A unique ID for each result entry
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('quiz_identifier'); // e.g., 'linear_regression_quiz'
            $table->unsignedTinyInteger('score'); // To store the percentage (0-100)
            $table->timestamps();

            // Ensure a user has only one result for a specific quiz
            $table->unique(['user_id', 'quiz_identifier']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz_results');
    }
};