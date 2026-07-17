<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Chạy toàn bộ Seeder
     */
    public function run(): void
    {
        // Gọi StudentSeeder
        $this->call([
            StudentSeeder::class,
        ]);
    }
}