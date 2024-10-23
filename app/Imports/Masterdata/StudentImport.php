<?php

namespace App\Imports\Masterdata;

use App\Models\Student;
use App\Models\StudentClass;
use App\Models\User;
use Illuminate\Support\Collection;
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
        if (count($row) < 6) {
            return null;
        }

        $class = StudentClass::where('code', $row[2])->first();
        if (!$class) {
            // Handle the case where the class is not found
            return null; // or throw an exception
        }
        try {
            $user = User::create([
                'name' => $row[1],
                'email' => $row[3],
                'username' => $row[0],
                'password' => bcrypt('pass' . $row[0]),
            ]);

            $user->assignRole('mahasiswa'); // pastikan role sudah ada

            $student = Student::create([
                'nim' => $row[0],
                'name' => $row[1],
                'student_class_id' => $class->id,
                'number_phone' => $row[4],
                'address' => $row[5],
                'email' => $row[3],
            ]);

            return $student;
        } catch (\Exception $e) {
            // Log error or handle the exception
            Log::error('Error importing student: ' . $e->getMessage());
            return null; // or throw a new exception
        }
    }
}
