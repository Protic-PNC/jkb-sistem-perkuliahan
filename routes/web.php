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
        Route::resource('study_programs', StudyProgramController::class)->middleware('role:superadmin');
        Route::resource('student_classes', StudentClassController::class)->middleware('role:superadmin');
        Route::resource('positions', PositionController::class)->middleware('role:superadmin');
        Route::get('/users/create2', [AuthenticatedSessionController::class, 'create2'])->name('users.create2')->middleware('role:superadmin');
        Route::post('/users/store2', [AuthenticatedSessionController::class, 'store2'])->name('users.store2')->middleware('role:superadmin');
    });

});

require __DIR__.'/auth.php';
