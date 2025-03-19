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
        Route::get('/recorded-class', 'recordedClass')->name('student.recorded-class');
        Route::get('/view-recorded-class/{id}', 'viewRecordedClass')->name('student.view-recorded-class');
        Route::post('/add-comments', 'addComments')->name('student.add-comments');


        Route::get('/quiz', 'quiz')->name('student.quiz');
        Route::get('/daily-sadhna-report', 'dailySadhnaReport')->name('student.daily-sadhana-report');
        Route::post('/store-daily-sadhna-report', 'storeDailySadhanaReport')->name('student.store-daily-sadhana-report');
        Route::get('/ask-question-answer', 'askQuestionAnswer')->name('student.ask-question-answer');
        Route::post('/store-question-answer', 'storeQuestionAnswer')->name('student.store-question-answer');
        Route::get('/get-question-answer-details/{id}', 'getQuestionAnswerDetails')->name('student.get-question-answer-details');
        Route::get('/assignment', 'assignment')->name('student.assignment');
        Route::get('/view-assignment/{assignment_id}', 'viewAssignment')->name('student.view-assignment');
        Route::post('/submit-assignment/{assignment_id}', 'submitAssignment')->name('student.submit-assignment');
        // Online Live Classes
        Route::get('/live-classes', 'liveClasses')->name('student.live-classes');
    });

    Route::controller(AttendanceController::class)->group(function () {
        Route::get('/attendance', 'viewAttendance')->name('student.attendance');
    });
});
