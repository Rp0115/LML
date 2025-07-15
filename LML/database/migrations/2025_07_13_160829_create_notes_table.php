<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            // Note identifier, like 'linearReg'
            $table->string('id'); 

            // Links the note to a user
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Holds the note's text
            $table->text('content')->nullable();

            // Standard created_at and updated_at columns
            $table->timestamps();

            // Define a composite primary key
            $table->primary(['id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};