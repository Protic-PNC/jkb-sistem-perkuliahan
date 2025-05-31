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
        if (count($row) < 5) {
            return null;
        }
        Log::info('row:', $row);

        $class = StudentClass::where('code', trim($row[5]))->first();

        if (!$class) {
           
            return null; // or throw an exception
        }
        

        DB::beginTransaction();

        try {
            
            $user = User::create([
                'name' => $row[1],
                'email' => $row[2] . '@pnc.ac.id',
                'avatar' => ' ', 
                'password' => bcrypt( $row[2]),
            ]);
            
        
            Log::info('user:', [$user]);
            $user->assignRole('mahasiswa');
        
            $student = Student::create([
                'nim' => $row[2],
                'name' => $row[1],
                'user_id' => $user->id,
                'student_class_id' => $class->id,
                'number_phone' => $row[4],
                'address' => $row[3], 
            ]);
        

            Log::info('student:', [$student]);
            DB::commit();
        } catch (\Exception $e) {
            Log::error('Exception caught: ' . $e->getMessage());
            
            DB::rollBack();
        }
    }
//     public function model(array $row)
// {
//     if (count($row) < 6) {
//         Log::warning('Row does not have enough columns', $row);
//         throw new \Exception("Invalid row format: not enough columns");
//     }

//     Log::info('Import row: ', $row);

//     try {
//         $class = StudentClass::where('code', trim($row[5]))->first();
//         if (!$class) {
//             throw new \Exception("KODE KELAS tidak ditemukan: " . $row[5]);
//         }

//         $email = strtolower($row[2]) . '@pnc.ac.id';
//         if (User::where('email', $email)->exists()) {
//             throw new \Exception("Email duplikat: " . $email);
//         }

//         DB::beginTransaction();

//         $user = User::create([
//             'name' => $row[1],
//             'email' => $email,
//             'password' => bcrypt($row[2]),
//         ]);

//         $user->assignRole('mahasiswa');

//         $student = Student::create([
//             'nim' => $row[2],
//             'name' => $row[1],
//             'user_id' => $user->id,
//             'student_class_id' => $class->id,
//             'number_phone' => $row[4],
//             'address' => $row[3],
//         ]);

//         DB::commit();

//         Log::info('Import successful for row' . ['student_id' => $student->id]);
//         return $student; // Kembalikan model Student

//     } catch (\Exception $e) {
//         DB::rollBack();
//         Log::error('Student import error', [
//             'message' => $e->getMessage(),
//             'row' => $row,
//         ]);
//         throw $e; // Re-throw exception agar bisa ditangkap oleh Laravel Excel
//     }
// }


}
