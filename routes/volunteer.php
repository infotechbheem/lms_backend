<?php

use App\Http\Controllers\Auth\Volunteer\DashboardController as VolunteerDashboardController;
use App\Http\Controllers\Auth\Volunteer\VolunteerWorkController;
use Illuminate\Support\Facades\Route;

Route::middleware(['volunteer_auth', 'clear_cache'])->prefix('auth/volunteer')->group(function () {
    Route::controller(VolunteerDashboardController::class)->group(function () {
        Route::get('/dashboard', 'dashbaord')->name('volunteer.dashboard');
        Route::get('/logout', 'volunteerLogout')->name('volunteer.logout');
    });

    Route::controller(VolunteerWorkController::class)->group(function () {
        Route::get('/student-registration', 'studentRegistration')->name('volunteer.student-registration');
        Route::post('/store-student-registration', 'storeStudentRegistration')->name('volunteer.store-student-registration');
        Route::get('/all-registered-student', 'allRegisteredStudent')->name('volunteer.all-registered-student');
        Route::get('/view-student-details/{student_id}', 'viewStudentDetails')->name('volunteer.view-student-details');
    });
});
