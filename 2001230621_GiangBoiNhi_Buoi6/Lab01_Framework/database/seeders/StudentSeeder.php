<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// Import Model Student
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Chạy Seeder
     */
    public function run(): void
    {
        // Tạo 20 sinh viên
        Student::factory()
                ->count(20)
                ->create();
    }
}