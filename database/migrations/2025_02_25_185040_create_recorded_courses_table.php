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
        Schema::create('recorded_courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_id');
            $table->string('question_answer_access')->nullable();
            $table->string('comments')->nullable();
            $table->string('level')->nullable();
            $table->text( 'thumbnail')->nullable();
            $table->text('intro_video_path')->nullable();
            $table->unsignedBigInteger('duration')->nullable();
            $table->string('video_quality')->nullable();
            $table->date('upload_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recorded_courses');
    }
};
