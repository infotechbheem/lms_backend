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
        Schema::create('physical_classes', function (Blueprint $table) {
            $table->id();
            $table->string('course_title')->nullable();
            $table->string('class_title')->nullable();
            $table->string('class_type')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->time('time')->nullable();
            $table->string('venue')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('coordinator')->nullable();
            $table->string('fee_type')->nullable();
            $table->string('currency')->nullable();
            $table->string('discount_price')->nullable();
            $table->string('membership_id')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
