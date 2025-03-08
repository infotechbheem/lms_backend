<?php

use App\Http\Controllers\Auth\Admin\DashboardController;
use App\Http\Controllers\Auth\Student\AttendanceController;
use App\Http\Controllers\Auth\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Auth\Student\StudentCourseController;
use Illuminate\Support\Facades\Route;

Route::middleware(['student_auth', 'clear_cache'])->prefix('auth/student')->group(function () {
    Route::controller(StudentDashboardController::class)->group(function () {
        Route::get('/dashboard', 'dashbaord')->name('student.dashboard');
        Route::get('/profile', 'profile')->name('student.profile');
        Route::post('/update-profile-details', 'updateProfileDetails')->name('student.update-profile-details');
        Route::post('/subscribe-newslatters', 'subscribeNewslatters')->name('student.subscribe-newslatters');
        Route::get('/logout', 'studentLogout')->name('student.logout');
        Route::post('/update-password-change', 'updatePasswordChange')->name('student.update-password-change');
    });

    Route::controller(StudentCourseController::class)->prefix('course')->group(function () {
        Route::get('/', 'course')->name('student.course');
    });

    Route::controller(AttendanceController::class)->group(function () {
        Route::get('/attendance', 'viewAttendance')->name('student.attendance');
    });
});
