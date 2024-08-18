<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CourseLecturerController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudyProgramController;
use App\Http\Controllers\UserController;
use App\Models\Student;
use App\Models\StudyProgram;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('dashboard', DashboardController::class)->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('masterdata')->name('masterdata.')->group(function(){
        Route::resource('users', UserController::class)->middleware('role:super_admin');
        Route::resource('study_programs', StudyProgramController::class)->middleware('role:super_admin');
        Route::resource('student_classes', StudentClassController::class)->middleware('role:super_admin');
        Route::resource('positions', PositionController::class)->middleware('role:super_admin');   
        Route::resource('courses', CoursesController::class)->middleware('role:super_admin'); 

        Route::get('/students/index', [StudentController::class,'index'])->name('students.index');
        Route::get('/students/create/{userId}', [StudentController::class, 'create'])->name('students.create');
        Route::get('/students/show/{userId}', [StudentController::class, 'show'])->name('students.show');
        Route::get('/students/edit/{id}', [StudentController::class,'edit'])->name('students.edit');
        Route::post('/students/store/{userId}', [StudentController::class, 'store'])->name('students.store');
        Route::put('/students/update/{id}', [StudentController::class, 'update'])->name('students.update');
        Route::delete('/students/destroy/{id}', [StudentController::class, 'destroy'])->name('students.destroy');

        Route::get('/lecturers/index', [LecturerController::class,'index'])->name('lecturers.index');
        Route::get('/lecturers/create/{userId}', [LecturerController::class, 'create'])->name('lecturers.create');
        Route::get('/lecturers/show/{userId}', [LecturerController::class, 'show'])->name('lecturers.show');
        Route::get('/lecturers/edit/{id}', [LecturerController::class,'edit'])->name('lecturers.edit');
        Route::post('/lecturers/store/{userId}', [LecturerController::class, 'store'])->name('lecturers.store');
        Route::put('/lecturers/update/{id}', [LecturerController::class, 'update'])->name('lecturers.update');
        Route::delete('/lecturers/destroy/{id}', [LecturerController::class, 'destroy'])->name('lecturers.destroy');

        Route::get('/courses/assign/course/lecturer/{lecturer}', [CourseLecturerController::class,'create'])->name('assign.course.lecturer');
        Route::post('/courses/store/course/lecturer/{lecturer}', [CourseLecturerController::class,'store'])->name('store.course.lecturer');
        Route::resource('course_lecturers', CourseLecturerController::class)->middleware('role:super_admin');
        
        
    });


    Route::prefix('lecture')->name('lecture.')->group(function(){
        Route::resource('lecturers', LecturerController::class)->middleware('role:super_admin|dosen');
    });

    //students
    
    
    

});

require __DIR__.'/auth.php';
