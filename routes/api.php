<?php

use App\Http\Controllers\Auth\Admin\Api\WebApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UniversalApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ============================ Universal Api Start =======================
Route::controller(UniversalApiController::class)->group(function () {
    Route::post('/check-email-availability', 'checkEmail')->name("check-email-availability"); 
    Route::post('/check-phone_number-availability', 'checkPhoneNumber')->name("check-phone_number-availability"); 
    Route::get('/get-membership-records',  'getMembershipDetails')->name("get-membership-records");
});



// ============================ Web Api Start =======================
Route::controller(WebApiController::class)->group( function () {
    Route::get('/get-membership-details', 'getMembershipDetails')->name('get-membership-details');
    Route::get('/get-calling-response', 'getCallingResponse')->name('get-calling-response');
    Route::get('/get-student-record', 'getStudentRecord')->name('get-student-record');
    Route::get('/get-student-by-membership', 'getStudentByMembership')->name('get-student-by-membership');
    Route::get('/get-student-by-course', 'getStudentByCourse')->name('get-student-by-course');
    Route::get('/get-course-details','getCourseDetails')->name('get-course-details'); 
    Route::get('/get-course-material-details', 'getMaterialDetails')->name('get-course-material-details');

});


// ============================ Web Api End =========================


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::post('login', [AuthController::class, 'login']);
Route::group(['prefix' => 'auth'], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});
