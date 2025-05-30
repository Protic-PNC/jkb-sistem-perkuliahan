<?php

use App\Http\Controllers\AttendenceListController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\CourseClassController;
use App\Http\Controllers\CourseLecturerController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\Lecturer\AttendanceListController;
use App\Http\Controllers\Lecturer\L_LecturerDocumentController;
use App\Http\Controllers\Lecturer\L_PersetujuanDokumenController;
use App\Http\Controllers\Lecturer\LecturerDocumentController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\LecturerPositionController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\Student\M_LecturerDocumentController;
use App\Http\Controllers\Super_Admin\A_AttendenceListController;
use App\Http\Controllers\Super_Admin\A_Lecturer_DocumentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\M_AbsensiController;
use App\Http\Controllers\StudentClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudyProgramController;
use App\Http\Controllers\UserController;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\StudyProgram;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');
// Route::get('/dashboard', [DashboardController::class, 'index'])->name('login');



Route::middleware('auth')->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::get('/dashboard/admin/{attendanceListId}', [DashboardController::class, 'index_admin'])->name('dashboard.admin');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('dokumen-perkuliahan')->name('dokumen_perkuliahan.')->middleware(['role:super_admin'])->group(function(){
     Route::get('/kelola/index', [A_Lecturer_DocumentController::class,'index'])->name('kelola.index');
     Route::get('/kelola/create', [A_Lecturer_DocumentController::class, 'create'])->name('kelola.create');
     Route::get('/kelola/show/{id}', [A_Lecturer_DocumentController::class, 'show'])->name('kelola.show');
     Route::get('/kelola/edit/{id}', [A_Lecturer_DocumentController::class,'edit'])->name('kelola.edit');
     Route::post('/kelola/store', [A_Lecturer_DocumentController::class, 'store'])->name('kelola.store');
     Route::put('/kelola/update/{id}', [A_Lecturer_DocumentController::class, 'update'])->name('kelola.update');
     Route::delete('/kelola/destroy/{id}', [A_Lecturer_DocumentController::class, 'destroy'])->name('kelola.destroy');
     Route::get('/daftar/daftar-index', [A_Lecturer_DocumentController::class,'daftar_index'])->name('daftar.index');
     Route::get('/daftar/absensi-perkuliahan/{id}', [A_Lecturer_DocumentController::class, 'absensi_perkuliahan'])->name('daftar.absensi-perkuliahan');
    Route::get('/daftar/jurnal-perkuliahan/{id}', [A_Lecturer_DocumentController::class, 'jurnal_perkuliahan'])->name('daftar.jurnal_perkuliahan');

    });
    Route::prefix('masterdata')->name('masterdata.')->middleware(['role:super_admin'])->group(function(){
        Route::resource('users', UserController::class);
        Route::resource('periode', PeriodeController::class);
        // Route::resource('jadwal', JadwalController::class);
        Route::resource('study_programs', StudyProgramController::class);
        
        Route::resource('student_classes', StudentClassController::class);
        Route::resource('positions', PositionController::class);   
        Route::resource('courses', CoursesController::class); 
         Route::get('/jadwal/index', [JadwalController::class, 'index'])->name('jadwal.index');
         Route::get('/jadwal/edit/{id}', [JadwalController::class, 'edit'])->name('jadwal.edit');

        Route::get('/students/index', [StudentController::class,'index'])->name('students.index');
        Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
        Route::get('/students/show/{userId}', [StudentController::class, 'show'])->name('students.show');
        Route::get('/students/edit/{id}', [StudentController::class,'edit'])->name('students.edit');
        Route::post('/students/store', [StudentController::class, 'store'])->name('students.store');
        Route::post('/students/import', [StudentController::class, 'import'])->name('students.import');
        Route::put('/students/update/{id}', [StudentController::class, 'update'])->name('students.update');
        Route::delete('/students/destroy/{id}', [StudentController::class, 'destroy'])->name('students.destroy');

        
    Route::get('/export/studentclass', [StudentClass::class, 'export_siswa'])->name('student_class.export');
        Route::get('/lecturers/index', [LecturerController::class,'index'])->name('lecturers.index');
        Route::get('/lecturers/create', [LecturerController::class, 'create'])->name('lecturers.create');
        Route::get('/lecturers/show/{userId}', [LecturerController::class, 'show'])->name('lecturers.show');
        Route::get('/lecturers/edit/{id}', [LecturerController::class,'edit'])->name('lecturers.edit');
        Route::post('/lecturers/store', [LecturerController::class, 'store'])->name('lecturers.store');
        Route::put('/lecturers/update/{id}', [LecturerController::class, 'update'])->name('lecturers.update');
        Route::delete('/lecturers/destroy/{id}', [LecturerController::class, 'destroy'])->name('lecturers.destroy');

        Route::get('/assign/course/lecturer/{lecturer}', [CourseLecturerController::class,'create'])->name('assign.course.lecturer');
        Route::post('/store/course/lecturer/{lecturer}', [CourseLecturerController::class,'store'])->name('store.course.lecturer');
        Route::resource('course_lecturers', CourseLecturerController::class);

        Route::get('/assign/lecturer/position/{lecturer}', [LecturerPositionController::class,'create'])->name('assign.lecturer.position');
        Route::post('/store/lecturer/position/{lecturer}', [LecturerPositionController::class,'store'])->name('store.lecturer.position');
        Route::resource('lecturer_positions', LecturerPositionController::class);

        Route::get('/assign/course/class/{student_class}', [CourseClassController::class,'create'])->name('assign.course.class');
        Route::post('/store/course/class/{student_class}', [CourseClassController::class,'store'])->name('store.course.class');
        Route::resource('course_classes', CourseClassController::class); 

       
        Route::get('/get-courses-by-class/{classId}', [A_Lecturer_DocumentController::class, 'getCoursesByClass']);
        Route::get('/get-lecturer-by-course/{courseId}', [A_Lecturer_DocumentController::class, 'getLecturerByClass']);
        

        //Route::resource('attendence_lists', A_AttendenceListController::class)->middleware('role:super_admin');
    });

    Route::get('/cetak-daftar-hadir/{id}', [CetakController::class, 'cetak_dh'])->name('cetak.daftar.hadir');
    Route::get('/cetak-jurnal/{id}', [CetakController::class, 'cetak_jurnal'])->name('cetak.jurnal');
    Route::get('jadwal/download/{id}', [JadwalController::class, 'download'])->name('jadwal.download');
    Route::post('jadwal/update/{id}', [JadwalController::class, 'update'])->name('jadwal.update');
   

    //dosen->daftar matkul->daftar kelas->jurnal dan absensi
    Route::prefix('d')->name('d.')->middleware(['role:dosen'])->group(function(){
        Route::get('/dokumen-perkuliahan/{nidn}', [L_LecturerDocumentController::class, 'index'])->name('dokumen_perkuliahan');
        Route::get('/daftar-dokumen-perkuliahan/{nidn}', [L_LecturerDocumentController::class, 'index2'])->name('daftar_dokumen_perkuliahan');
      
        Route::get('/dokumen-perkuliahan/create/{id}', [L_LecturerDocumentController::class, 'create'])->name('dokumen_perkuliahan.create');
        Route::post('/dokumen-perkuliahan/store/{id}', [L_LecturerDocumentController::class, 'store'])->name('dokumen_perkuliahan.store');
        Route::get('/dokumen-perkuliahan/edit/{id}', [L_LecturerDocumentController::class,'edit'])->name('dokumen_perkuliahan.edit');
        Route::put('/dokumen-perkuliahan/update/{id}', [L_LecturerDocumentController::class, 'update'])->name('dokumen_perkuliahan.update');
        Route::get('/dokumen-perkuliahan/details/{id}', [L_LecturerDocumentController::class, 'details'])->name('dokumen_perkuliahan.details');
        
        Route::post('/dokumen-perkuliahan/store-students', [L_LecturerDocumentController::class, 'storeStudents'])->name('dokumen_perkuliahan.storeStudents');
        Route::get('/dokumen-perkuliahan/absensi/{id}', [L_LecturerDocumentController::class,'absensi'])->name('dokumen_perkuliahan.absensi');
        Route::get('/dokumen-perkuliahan/edit-student/{id}', [L_LecturerDocumentController::class,'edit_student'])->name('dokumen_perkuliahan.edit_student');
        Route::put('/dokumen-perkuliahan/update_student/{id}', [L_LecturerDocumentController::class, 'update_student'])->name('dokumen_perkuliahan.update_student');
        Route::post('/dokumen-perkuliahan/selesai/{id}', [L_LecturerDocumentController::class, 'selesai_document'])->name('dokumen_perkuliahan.selesai');

        Route::get('/daftar-persetujuan-dokumen/{id}', [L_PersetujuanDokumenController::class, 'index'])->name('daftar_persetujuan_dokumen');
        Route::get('/daftar-persetujuan-dokumen/detail/{id}', [L_PersetujuanDokumenController::class, 'details'])->name('daftar_persetujuan_dokumen.detail');
        Route::post('/dokumen-perkuliahan/verifikasi-massal/{id}', [L_PersetujuanDokumenController::class, 'verifikasiMassal'])->name('dokumen_perkuliahan.verifikasi_massal');
        Route::get('/dokumen-perkuliahan/detail-verifikasi/{id}', [L_PersetujuanDokumenController::class, 'detail_verifikasi'])->name('dokumen_perkuliahan.detail_verifikasi');
        Route::post('/dokumen-perkuliahan/setuju_kajur/{id}', [L_PersetujuanDokumenController::class, 'setuju_kajur'])->name('dokumen_perkuliahan.setuju_kajur');

        

        Route::get('/student_class/{id}', [L_LecturerDocumentController::class, 'student_class_index'])->name('student_class');
        // Route::get('attendenceList/{classId}/{code}', [AttendanceListController::class, 'index'])->name('attendenceList.index');
        // Route::get('attendenceList/create/{id}', [AttendanceListController::class, 'create'])->name('attendenceList.create');
        
        Route::get('journal/{id}', [JournalController::class, 'index'])->name('journal.index');
        
    });
    Route::prefix('m')->name('m.')->middleware(['role:mahasiswa'])->group(function(){
        Route::get('/dokumen-perkuliahan/{id}', [M_LecturerDocumentController::class, 'index'])->name('dokumen_perkuliahan');
        Route::get('/riwayat-absensi/{nim}', [M_LecturerDocumentController::class, 'riwayat_absensi'])->name('riwayat_absensi');
        
        
        Route::post('/dokumen-perkuliahan/verifikasi/{id}', [M_LecturerDocumentController::class, 'verifikasi'])->name('dokumen_perkuliahan.verifikasi');

        Route::get('/dokumen-perkuliahan/details/{id}', [M_LecturerDocumentController::class, 'details'])->name('dokumen_perkuliahan.details');
        Route::get('/dokumen-perkuliahan/detail-verifikasi/{id}', [M_LecturerDocumentController::class, 'detail_verifikasi'])->name('dokumen_perkuliahan.detail_verifikasi');
        Route::get('/dokumen-perkuliahan/absensi/{id}', [M_LecturerDocumentController::class,'absensi'])->name('dokumen_perkuliahan.absensi');
        Route::get('/absensi-mahasiswa/{id}', [M_AbsensiController::class, 'absensi_mahasiswa'])->name('absensi_mahasiswa');

        // Route::get('attendenceList/{classId}/{code}', [AttendanceListController::class, 'index'])->name('attendenceList.index');
        // Route::get('attendenceList/create/{id}', [AttendanceListController::class, 'create'])->name('attendenceList.create');
        
        // Route::get('journal/{id}', [JournalController::class, 'index'])->name('journal.index');
        
    });
    
    
    

});

require __DIR__.'/auth.php';
