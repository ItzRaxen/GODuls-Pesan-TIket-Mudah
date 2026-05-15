<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a test user
        User::updateOrCreate(
            ['email' => 'user@goduls.com'],
            [
                'name'     => 'Test Traveler',
                'password' => Hash::make('password123'),
            ]
        );

        // Create an admin user (optional)
        User::updateOrCreate(
            ['email' => 'admin@goduls.com'],
            [
                'name'     => 'Administrator',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
            ]
        );
    }
}
