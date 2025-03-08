<?php

use App\Http\Controllers\Auth\Volunteer\DashboardController as VolunteerDashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['volunteer_auth', 'clear_cache'])->prefix('auth/volunteer')->group(function () {
    Route::controller(VolunteerDashboardController::class)->group(function () {
        Route::get('/dashboard', 'dashbaord')->name('volunteer.dashboard');
        Route::get('/logout', 'volunteerLogout')->name('volunteer.logout');
    });
});
