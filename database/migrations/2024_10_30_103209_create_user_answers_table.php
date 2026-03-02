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
            $table->unsignedBigInteger('course_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('quiz_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->boolean('isCorrect');
            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('quiz_id')->references('id')->on('quizzes');
            $table->timestamps();
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
