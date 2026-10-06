<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ExtracurricularController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


Route::middleware('auth')->group(function () {


    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


    Route::resource('users', UserController::class);
    Route::resource('profiles', ProfileController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('students', StudentController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('classrooms', ClassroomController::class);
    Route::resource('schedules', ScheduleController::class);
    Route::resource('enrollments', EnrollmentController::class);
    Route::resource('assignments', AssignmentController::class);
    Route::resource('submissions', SubmissionController::class);
    Route::resource('grades', GradeController::class);
    Route::resource('announcements', AnnouncementController::class);
    Route::resource('tags', TagController::class);
    Route::resource('extracurriculars', ExtracurricularController::class);
});