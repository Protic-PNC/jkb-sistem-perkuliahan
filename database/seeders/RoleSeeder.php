<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = Role::create([
            'name' => 'super_admin'
        ]);
        $dosenRole = Role::create([
            'name' => 'dosen'
        ]);
        $mahasiswaRole = Role::create([
            'name' => 'mahasiswa'
        ]);

        $userSuperAdmin = User::create([
            'name' => 'Adisa L',
            // 'avatar' => 'images/avatar-default.svg',
            'email' => 'adisa@admin.com',
            'password' => bcrypt('12345678'),
            
        ]);

       

        //$userMahasiswa->assignRole($mahasiswaRole);
        $userSuperAdmin->assignRole($superAdminRole);
        

        //Add debug information
        Log::info('User created with ID: ' . $userSuperAdmin->id);
        Log::info('Assigned role: ' . $superAdminRole->name);
        Log::info('User roles after assignment: ' . $userSuperAdmin->roles->pluck('name'));
    }
}
