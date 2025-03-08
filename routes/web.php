<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//======================= Admin Login ===============================
Route::get('/admin-login', function () {
    return view('admin-login');
});

//======================= Mentor Login ===============================
Route::get('/mentor-login', function () {
    return view('mentor-login');
});


//======================= Student Login ==============================
Route::get('/student-login', function () {
    return view('student-login');
});



//======================= Volunteer Login ==============================
Route::get('/volunteer-login', function () {
    return view('volunteer-login');
});

Route::controller(AuthController::class)->group(function () {
    Route::post('/admin-login', 'adminLogin')->name('admin-login');
    Route::post('/student-login', action: 'studentLogin')->name('student-login');
    Route::post('/mentor-login', 'mentorLogin')->name('mentor-login');
    Route::post('/volunteer-login', 'volunteerLogin')->name('volunteer-login');
});

require __DIR__ . '/admin.php';
require __DIR__ . '/mentor.php';
require __DIR__ . '/student.php';
require __DIR__ . '/volunteer.php';
