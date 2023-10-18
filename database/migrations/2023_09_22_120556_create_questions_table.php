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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->longText('content')->comment('The content of the question');
            $table->string('category')->index()->nullable()->comment('Category or domain of the question');
            $table->enum('difficulty_level', ['easy', 'medium', 'hard'])->index()->nullable()->comment('Difficulty level of the question');
            $table->string('tags')->nullable()->comment('Tags of the question');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
