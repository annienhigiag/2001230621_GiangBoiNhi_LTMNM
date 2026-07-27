<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::factory()
        ->count(5)
        ->hasProducts(10)
        ->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call(StudentCourseSeeder::class);

        \App\Models\User::factory(5)->create()->each(function ($user) {
        \App\Models\Profile::factory()->create([
            'user_id' => $user->id,
        ]);
    });
    }
}
