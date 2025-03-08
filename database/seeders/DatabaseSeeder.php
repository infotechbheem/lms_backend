<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin Seeder
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'username' => "01A2025",
            'user_type' => 'admin',
            'department' => 'admin',
        ]);

        $admin_role = Role::create(['name' => 'admin']);

        $admin->assignRole($admin_role);

        // Student Seeder
        $student = User::create([
            'name' => 'Student',
            'email' => 'student@student.com',
            'password' => bcrypt('password'),
            'username' => "01S2025",
            'user_type' => 'student',
            'department' => 'student',
        ]);

        $student_role = Role::create(['name' => 'student']);

        $student->assignRole($student_role);

        // Mentor Seeder
        $mentor = User::create([
            'name' => 'Mentor',
            'email' => 'mentor@mentor.com',
            'password' => bcrypt('password'),
            'username' => "01M2025",
            'user_type' => 'mentor',
            'department' => 'mentor',
        ]);

        $mentor_role = Role::create(['name' => 'mentor']);

        $mentor->assignRole($mentor_role);

        // Volunteer Seeder
        $volunteer = User::create([
            'name' => 'Volunteer',
            'email' => 'volunteer@volunteer.com',
            'password' => bcrypt('password'),
            'username' => "01V2025",
            'user_type' => 'volunteer',
            'department' => 'volunteer',
        ]);

        $volunteer_role = Role::create(['name' => 'volunteer']);

        $volunteer->assignRole($volunteer_role);
    }
}
