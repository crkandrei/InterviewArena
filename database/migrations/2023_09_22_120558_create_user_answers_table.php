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
        Schema::create('user_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->comment('User who provided the answer');
            $table->foreignId('question_id')->constrained()->onDelete('cascade')->comment('Question to which the answer was provided');
            $table->longText('answer_content')->comment('User\'s answer content');
            $table->foreignId('feedback_id')->nullable()->constrained()->onDelete('set null')->comment('Feedback provided for the answer');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['user_id', 'question_id']);
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_answers');
    }
};
