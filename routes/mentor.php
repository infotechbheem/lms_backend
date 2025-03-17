<?php

use App\Http\Controllers\Auth\Mentor\CourseController;
use App\Http\Controllers\Auth\Mentor\DashboardController as MentorDashboardController;
use App\Http\Controllers\Auth\Mentor\ReportController;
use App\Http\Controllers\Auth\Mentor\StudentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['mentor_auth', 'clear_cache'])->prefix('auth/mentor')->group(function () {
    Route::controller(MentorDashboardController::class)->group(function () {
        Route::get('/dashboard', 'dashbaord')->name('mentor.dashboard');
        Route::get('/logout', 'mentorLogout')->name('mentor.logout');
    });


    Route::controller(StudentController::class)->group(function () {
       
        Route::get('/students', 'student')->name('mentor.students');
        Route::get('/view-student-details/{student_id}', 'studentProfile')->name('mentor.student-profile-view');
        Route::post('/store-student-registration', 'storeStudentRegistration')->name('mentor.store-student-registration');
        Route::post('/submit-response', 'SubmitResponse')->name('mentor.submit-calling-response');
    });
    Route::controller(CourseController::class)->group(function () {
        Route::get('/courses', 'courses')->name('mentor.courses');
    });

    Route::controller(ReportController::class)->group(function () {
        Route::get('/reports', 'report')->name('mentor.reports');
    });
});
