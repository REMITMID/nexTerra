<?php

namespace Database\Seeders;

// database/seeders/AdminUserSeeder.php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Nexterra',
            'email' => 'admin@nexterra.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
    }
}