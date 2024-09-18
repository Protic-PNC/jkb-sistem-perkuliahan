<?php

use App\Http\Controllers\AttendenceListController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CourseClassController;
use App\Http\Controllers\CourseLecturerController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\Lecturer\AttendanceListController;
use App\Http\Controllers\Lecturer\L_LecturerDocumentController;
use App\Http\Controllers\Lecturer\LecturerDocumentController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\LecturerPositionController;
use App\Http\Controllers\Super_Admin\A_AttendenceListController;
use App\Http\Controllers\Super_Admin\A_Lecturer_DocumentController;
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

        Route::get('/assign/course/lecturer/{lecturer}', [CourseLecturerController::class,'create'])->name('assign.course.lecturer');
        Route::post('/store/course/lecturer/{lecturer}', [CourseLecturerController::class,'store'])->name('store.course.lecturer');
        Route::resource('course_lecturers', CourseLecturerController::class)->middleware('role:super_admin');

        Route::get('/assign/lecturer/position/{lecturer}', [LecturerPositionController::class,'create'])->name('assign.lecturer.position');
        Route::post('/store/lecturer/position/{lecturer}', [LecturerPositionController::class,'store'])->name('store.lecturer.position');
        Route::resource('lecturer_positions', LecturerPositionController::class)->middleware('role:super_admin');

        Route::get('/assign/course/class/{student_class}', [CourseClassController::class,'create'])->name('assign.course.class');
        Route::post('/store/course/class/{student_class}', [CourseClassController::class,'store'])->name('store.course.class');
        Route::resource('course_classes', CourseClassController::class)->middleware('role:super_admin'); 

        Route::get('/lecturer_documents/index', [A_Lecturer_DocumentController::class,'index'])->name('lecturer_documents.index');
        Route::get('/lecturer_documents/create', [A_Lecturer_DocumentController::class, 'create'])->name('lecturer_documents.create');
        Route::get('/lecturer_documents/show/{id}', [A_Lecturer_DocumentController::class, 'show'])->name('lecturer_documents.show');
        Route::get('/lecturer_documents/edit/{id}', [A_Lecturer_DocumentController::class,'edit'])->name('lecturer_documents.edit');
        Route::post('/lecturer_documents/store/', [A_Lecturer_DocumentController::class, 'store'])->name('lecturer_documents.store');
        Route::put('/lecturer_documents/update/{id}', [A_Lecturer_DocumentController::class, 'update'])->name('lecturer_documents.update');
        Route::delete('/lecturer_documents/destroy/{id}', [A_Lecturer_DocumentController::class, 'destroy'])->name('lecturer_documents.destroy');

        Route::get('/get-courses-by-class/{classId}', [A_Lecturer_DocumentController::class, 'getCoursesByClass']);
        Route::get('/get-lecturer-by-course/{courseId}', [A_Lecturer_DocumentController::class, 'getLecturerByClass']);

        //Route::resource('attendence_lists', A_AttendenceListController::class)->middleware('role:super_admin');
    });

    //dosen->daftar matkul->daftar kelas->jurnal dan absensi
    Route::prefix('lecturer')->name('lecturer.')->group(function(){
        Route::get('/index/{nidn}', [L_LecturerDocumentController::class, 'index'])->name('index');
        Route::get('/lecturer_document/details', [L_LecturerDocumentController::class, 'details'])->name('lecturer_document.details');
        Route::get('/lecturer_document/create', [L_LecturerDocumentController::class, 'create'])->name('lecturer_document.create');
        Route::post('/lecturer_document/storeStudents', [L_LecturerDocumentController::class, 'storeStudents'])->name('lecturer_document.storeStudents');
        Route::post('/lecturer_document/store', [L_LecturerDocumentController::class, 'store'])->name('lecturer_document.store');
        Route::get('/lecturer_document/edit/{id}', [L_LecturerDocumentController::class,'edit'])->name('lecturer_document.edit');
        Route::put('/lecturer_document/update/{id}', [L_LecturerDocumentController::class, 'update'])->name('lecturer_document.update');


        Route::get('/student_class/{id}', [L_LecturerDocumentController::class, 'student_class_index'])->name('student_class');
        Route::get('attendenceList/{classId}/{code}', [AttendanceListController::class, 'index'])->name('attendenceList.index');
        Route::get('attendenceList/create/{id}', [AttendanceListController::class, 'create'])->name('attendenceList.create');
        
        Route::get('journal/{id}', [JournalController::class, 'index'])->name('journal.index');
        
    });

    


    

    //students
    
    
    

});

require __DIR__.'/auth.php';
