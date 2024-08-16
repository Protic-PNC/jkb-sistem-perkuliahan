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
        Route::get('/students/show/{userId}', [StudentController::class, 'show'])->name('students.show');
        Route::resource('study_programs', StudyProgramController::class)->middleware('role:super_admin');
        Route::resource('student_classes', StudentClassController::class)->middleware('role:super_admin');
        Route::resource('positions', PositionController::class)->middleware('role:super_admin');   
        Route::resource('courses', CoursesController::class)->middleware('role:super_admin'); 

        Route::get('/students/index', [StudentController::class,'index'])->name('students.index');
        Route::get('/students/create/{userId}', [StudentController::class, 'create'])->name('students.create');
        Route::get('/students/edit/{id}', [StudentController::class,'edit'])->name('students.edit');
        Route::post('/students/store/{userId}', [StudentController::class, 'store'])->name('students.store');
        Route::put('/students/update/{id}', [StudentController::class, 'update'])->name('students.update');
        Route::delete('/students/destroy/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
        
    });


    Route::prefix('lecture')->name('lecture.')->group(function(){
        Route::resource('lecturers', LecturerController::class)->middleware('role:super_admin|dosen');
    });

    //students
    
    
    Route::get('/masterdata/create/{userId}', [StudentController::class, 'create'])->name('masterdata.lecturers.create');
    
    

});

require __DIR__.'/auth.php';
