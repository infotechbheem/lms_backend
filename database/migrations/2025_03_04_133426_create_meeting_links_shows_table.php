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
        Schema::create('meeting_links_shows', function (Blueprint $table) {
            $table->id();
            $table->string('meeting_id');
            $table->string('course_id')->nullable();
            $table->string('membership_id')->nullable();
            $table->string('student_id')->nullable(); //
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meeting_links_shows');
    }
};
