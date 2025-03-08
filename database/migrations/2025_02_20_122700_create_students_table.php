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
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            // Student ID (Unique identifier for each student)
            $table->string('student_id')->unique();

            // Student's first and last name
            $table->string('first_name');
            $table->string('last_name')->nullable();

            // Student's contact info
            $table->string('email')->unique();
            $table->string('phone_number')->nullable();

            // Student's date of birth and gender
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();

            // Address fields
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('country')->nullable();

            // Emergency contact details
            $table->string('emergency_contact_phone')->nullable();
            $table->string('emergency_contact_email')->nullable();

            // Profile picture (nullable)
            $table->string('profile_picture')->nullable();

            // Occupation Details
            $table->string('occupation')->nullable(); // Occupation of the student (e.g., Teacher, Software Engineer)
            $table->decimal('annual_income', 10, 2)->nullable(); // Annual income of the student (optional)

            $table->string('mentor_id')->nullable(); //
            // Program and Course Enrollment
            $table->string('course_id')->nullable();

            $table->string('membership_id')->nullable(); //

            $table->string('created_by')->nullable(); //

            // Timestamps for created_at and updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
