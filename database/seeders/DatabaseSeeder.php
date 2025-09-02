<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'student']);

        // Create a student user (check if exists first)
        $student = User::firstOrCreate(
            ['email' => 'kumail@student.com'], // email check
            [
                'name' => 'Kumail',
                'password' => bcrypt('password'),
            ]
        );
        $student->assignRole('student');

        // Create an admin user (check if exists first)
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'], // email check
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
            ]
        );
        $admin->assignRole('admin');
    }
}
