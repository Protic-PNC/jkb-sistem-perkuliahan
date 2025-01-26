<?php

namespace App\Imports\Masterdata;

use App\Models\Student;
use App\Models\StudentClass;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class StudentImport implements ToModel, WithStartRow
{
    /**
     * Define the starting row for the import.
     *
     * @return int
     */
    public function startRow(): int
    {
        return 4; // Data starts from row 4
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (count($row) < 4) {
            return null;
        }
        Log::info($row);

        $class = StudentClass::where('code', $row[2])->first();
        if (!$class) {
            // Handle the case where the class is not found
            return null; // or throw an exception
        }
        DB::beginTransaction();
\Log::info('Transaction started');

try {
    // Sebelum create user
   Log::info('About to create user');
    
    $user = User::create([
        'name' => $row[1],
        'email' => $row[3],
        'username' => (string)$row[0], // konversi float ke string
        'password' => bcrypt('pass' . $row[0]),
    ]);
    
   Log::info('User created with ID: ' . $user->id);
   Log::info('User data: ' . json_encode($user->toArray()));
    
    // Sebelum assign role
   Log::info('About to assign role');
    $user->assignRole('mahasiswa');
   Log::info('Role assigned successfully');
    
    // Sebelum create student
   Log::info('About to create student');
    $student = Student::create([
        'nim' => (string)$row[0],
        'name' => $row[1],
        'user_id' => $user->id,
        'student_class_id' => $class->id,
        'number_phone' => $row[4],
        'address' => $row[4] ?? '', // gunakan default jika tidak ada
        'email' => $row[3],
    ]);
    
   Log::info('Student created with ID: ' . $student->id);
   Log::info('Student data: ' . json_encode($student->toArray()));
    
   Log::info('About to commit transaction');
    DB::commit();
   Log::info('Transaction committed successfully');
    
    // Verifikasi setelah commit
    $verifyUser = User::find($user->id);
    $verifyStudent = Student::find($student->id);
    
   Log::info('Post-commit verification:');
   Log::info('User exists: ' . ($verifyUser ? 'Yes' : 'No'));
   Log::info('Student exists: ' . ($verifyStudent ? 'Yes' : 'No'));
    
} catch (\Exception $e) {
   Log::error('Exception caught: ' . $e->getMessage());
   Log::error('Exception trace: ' . $e->getTraceAsString());
    DB::rollBack();
   Log::info('Transaction rolled back');
    return null;
}
    }
}
