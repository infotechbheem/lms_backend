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
        Schema::create('sadhana_reports', function (Blueprint $table) {
            $table->id();
            $table->string('student_id');
            $table->time('wake_up_time')->nullable();
            $table->string('mangla_arti')->nullable();
            $table->unsignedBigInteger('chanting_round_before_9_am')->nullable();
            $table->unsignedBigInteger('chanting_round_between_9_am_to_9_pm')->nullable();
            $table->unsignedBigInteger('chanting_round_after_9_pm')->nullable();
            $table->unsignedBigInteger('hearing_duration_hour')->nullable();
            $table->unsignedBigInteger('hearing_duration_minute')->nullable();
            $table->unsignedBigInteger('reading_duration_hour')->nullable();
            $table->unsignedBigInteger('reading_duration_minute')->nullable();
            $table->time('sleeping_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sadhana_reports');
    }
};
