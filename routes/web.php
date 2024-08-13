<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
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
        
    });
    Route::prefix('lecture')->name('lecture.')->group(function(){
        Route::resource('lecturers', LecturerController::class)->middleware('role:super_admin|dosen');
    });

    Route::get('/students/index', [StudentController::class,'index'])->name('masterdata.students.index');
    Route::get('/students/create/{userId}', [StudentController::class, 'create'])->name('masterdata.students.create');
    Route::get('/masterdata/create/{userId}', [StudentController::class, 'create'])->name('masterdata.lecturers.create');
    Route::post('/students/store/{userId}', [StudentController::class, 'store'])->name('student.students.store');
    Route::post('/students/update/{id}', [StudentController::class, 'store'])->name('masterdata.students.update');
    Route::get('/students/show/{userId}', [StudentController::class, 'show'])->name('masterdata.students.show');
    Route::delete('/a/students/destroy/{userId}', [StudentController::class, 'destroy'])->middleware('role:admin')->name('masterdata.students.destroy');
    Route::prefix('student')->name('student.')->group(function(){
    
    });

});

require __DIR__.'/auth.php';
