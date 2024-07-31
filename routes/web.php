<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentClassController;
use App\Http\Controllers\StudyProgramController;
use App\Models\StudyProgram;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->name('admin.')->group(function(){
        Route::resource('study_programs', StudyProgramController::class)->middleware('role:super_admin');
        Route::resource('student_classes', StudentClassController::class)->middleware('role:super_admin');
        Route::resource('positions', PositionController::class)->middleware('role:super_admin');
        Route::get('/users/showUserCreation', [AuthenticatedSessionController::class, 'showUserCreation'])->name('users.showUserCreation')->middleware('role:super_admin');
        Route::post('/users/storeUserCreation', [AuthenticatedSessionController::class, 'storeUserCreation'])->name('users.storeUserCreation')->middleware('role:super_admin');
    });

});

require __DIR__.'/auth.php';
