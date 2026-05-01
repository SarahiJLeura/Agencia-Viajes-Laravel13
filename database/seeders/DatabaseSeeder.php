<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'patriciajimenezleu@gmail.com'],
            [
                'name' => 'Sarahi Jimenez',
                'role' => 'admin',
                'password' => Hash::make('admin123'),
            ]
        );
    }
}