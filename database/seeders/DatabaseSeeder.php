<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Task;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // 1. Create known test user
        $testUser = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // 2. Assign 10 tasks to the test user
        Task::factory(10)->create([
            'user_id' => $testUser->id,
        ]);

        // 3. Seed 5 more users with 10 tasks each
        User::factory(5)->create()->each(function ($user) {
            Task::factory(10)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
