<?php

use App\Http\Controllers\Auth\Admin\AttendanceController;
use App\Http\Controllers\Auth\Admin\DashboardController;
use App\Http\Controllers\Auth\Admin\MembershipController;
use App\Http\Controllers\Auth\Admin\OfflineClassesController;
use App\Http\Controllers\Auth\Admin\OnlineLiveClassesController;
use App\Http\Controllers\Auth\Admin\StudentController;
use App\Http\Controllers\Auth\Admin\RecordedCoursesController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin_auth', 'clear_cache'])->prefix('auth/admin')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'dashbaord')->name('admin.dashboard');
        Route::get('/logout', 'adminLogout')->name('admin.logout');
    });

    Route::controller(MembershipController::class)->prefix('membership')->group(function () {
        Route::get('/create-membership', 'createMembership')->name('admin.create-membership');
        Route::post('/store-membership', 'storeMembership')->name('admin.store-membership');
        Route::get('/all-memberships', 'allMemberships')->name('admin.all-membership');
        Route::get('/delete-membership/{id}', 'deleteMembership')->name('admin.delete-membership');
        Route::get('/create-courses', 'createCourse')->name(name: 'admin.create-courses');
        Route::get('/created-course', 'createdCourse')->name('admin.created-course');
        Route::get('/view-course-details/{course_id}', 'viewCourseDetails')->name('admin.view-course-details');
        Route::post('/store-course', action: 'storeCourse')->name('admin.store-course');
        Route::post('/store-class', 'storeClass')->name('admin.store-class');
        Route::get('/delete-course/{id}', 'deleteCourse')->name('admin.delete-course');
        Route::get('/delete-class/{id}', 'deleteClass')->name('admin.delete-class');
        Route::get('/student-change-status/{student_id}', 'studentChangeStatus')->name('admin.student-change-status');
    });

    Route::controller(StudentController::class)->prefix('student')->group(function () {
        Route::get('/', 'student')->name('admin.student');
        Route::post('/student-registration', 'studentRegistration')->name('admin.student-registration');
        Route::get('/calling-student-response-update', 'callingStudentUpdateResponse')->name('admin.calling-student-response-update');
        Route::post('/calling-student-response-store', 'callingStudentUpdateResponseStore')->name('admin.calling-student-response-store');
        Route::get('/mentor-allotment', 'mentorAllot')->name('admin.mentor-allotment');
        Route::post('/allot-mentr', 'allotmentor')->name('admin.allot-mentor');
        Route::get('/delete-mentor/{mentor_id}', 'deleteMentor')->name('admin.delete-mentor');
        Route::get('/register-volunteer', 'registerVolunteer')->name('admin.register-volunteer');
        Route::post('/store-volunteer', 'storeVolunteer')->name('admin.store-volunteer');
        Route::get('/delete-volunteer/{volunteer_id}', 'deleteVolunteer')->name('admin.delete-volunteer');
        Route::get('/view-student-profile/{student_id}', 'studentProfile')->name('admin.view-student-profile');
        Route::get('/class-reminder', 'classReminder')->name('admin.student-class-reminder');
        Route::post('/send-class-reminder', 'sendClassReminder')->name('admin.send-class-reminder');
        Route::get('/update-student-details/{student_id}', 'studentDetails')->name('admin.update-student-details');
        Route::post('/store-student-updated-details/{student_id}', 'storeStudentUpdatedDetails')->name('admin.store-student-updated-details');
    });

    Route::controller(AttendanceController::class)->prefix('attendance')->group(function () {
        Route::get('/add-attendance', 'addAttendance')->name('admin.add-attendance');
        Route::get('/view-attendance', 'viewAttendance')->name('admin.view-attendance');
        Route::post('/store-attendance', 'storeAttendance')->name('admin.store-attendance');
    });

    Route::controller(OnlineLiveClassesController::class)->group(function () {
        Route::get('/create-live-work-shop', 'createLiveWorkShop')->name('admin.create-live-work-shop');
        Route::post('/create-meeting', 'createMeeting')->name('admin.create-meeting');
        Route::get('/created-meetings', 'createdMeetings')->name('admin.created-meetings');
        Route::get('/get-metting-details/{meeting_id}', 'mettingDetails')->name('admin.get-metting-details');
        Route::get('/delete-meetings/{meeting_id}', 'deleteMeetings')->name('admin.delete-meetings');
        Route::post('/store-and-share-meetings-links','sendMeetingsLinks')->name('admin.store-meeting_links');
    });
    Route::controller(RecordedCoursesController::class)->group(function () {
        Route::get('/add-recording', 'addRecording')->name('admin.add-recording');
        Route::post('/store-recorded-course', 'storeRecordedCourse')->name('admin.store-recorded-course');
        Route::get('/add-assignmets', 'addAssignment')->name('admin.add-assignments');
    });
});
