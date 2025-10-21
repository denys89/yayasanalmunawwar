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
        // Create additional editor for testing
        User::create([
            'name' => 'Test Editor',
            'email' => 'test.editor@yayasanalmunawwar.org',
            'role' => 'editor',
            'password' => Hash::make('editor123'),
            'email_verified_at' => now(),
        ]);
    }
}
