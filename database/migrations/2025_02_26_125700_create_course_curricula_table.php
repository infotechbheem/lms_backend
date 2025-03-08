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
        Schema::create('course_curriculum', function (Blueprint $table) {
            $table->id();
            $table->string('course_id');
            $table->string('section_number');
            $table->string('section_title');
            $table->string('chapter_number');
            $table->text('chapter_name');
            $table->longText('chapter_content');
            $table->text('pdf_material');
            $table->text('video_material');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_curriculum');
    }
};
