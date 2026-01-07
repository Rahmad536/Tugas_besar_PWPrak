<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'username' => 'testuser',
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'user',
        ]);

        User::factory()->create([
            'username' => 'admin',
            'name' => 'Admin User',
            'email' => 'admin@growearth.com',
            'password' => bcrypt('password'), // Ensure password is hashed if factory doesn't do it dynamically enough for specific override
            'role' => 'admin',
        ]);
    }
}
