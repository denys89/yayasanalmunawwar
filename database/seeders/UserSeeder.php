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
        // Create Admin User
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@yayasanalmunawwar.org',
            'role' => 'admin',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
        ]);

        // Create additional admin for testing
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@yayasanalmunawwar.org',
            'role' => 'admin',
            'password' => Hash::make('superadmin123'),
            'email_verified_at' => now(),
        ]);

        // Create Editor Users
        User::create([
            'name' => 'Content Editor',
            'email' => 'editor@yayasanalmunawwar.org',
            'role' => 'editor',
            'password' => Hash::make('editor123'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Test Editor',
            'email' => 'test.editor@yayasanalmunawwar.org',
            'role' => 'editor',
            'password' => Hash::make('editor123'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'News Editor',
            'email' => 'news.editor@yayasanalmunawwar.org',
            'role' => 'editor',
            'password' => Hash::make('editor123'),
            'email_verified_at' => now(),
        ]);

        // Create Parent Users
        User::create([
            'name' => 'Parent User 1',
            'email' => 'parent1@example.com',
            'role' => 'parent',
            'password' => Hash::make('parent123'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Parent User 2',
            'email' => 'parent2@example.com',
            'role' => 'parent',
            'password' => Hash::make('parent123'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Test Parent',
            'email' => 'test.parent@example.com',
            'role' => 'parent',
            'password' => Hash::make('parent123'),
            'email_verified_at' => now(),
        ]);
    }
}
