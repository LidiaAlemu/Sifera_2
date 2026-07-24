<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@sifera.com',
            'password' => 'password123',
            'role' => 'Admin',
            'status' => 'Active',
        ]);

        User::create([
            'name' => 'Manager User',
            'email' => 'manager@sifera.com',
            'password' => 'password123',
            'role' => 'Manager',
            'status' => 'Active',
        ]);

        User::create([
            'name' => 'Test Customer',
            'email' => 'customer@sifera.com',
            'password' => 'password123',
            'role' => 'Customer',
            'status' => 'Active',
        ]);

        echo "Admin, Manager, and Customer users created!\n";
        echo "Login: admin@sifera.com / password123\n";
    }
}
