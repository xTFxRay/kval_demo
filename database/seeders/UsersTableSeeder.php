<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'surname' => 'Amin',
            'email' => 'admin@admin.com',
            'phone' => '123456789',
            'password' => Hash::make('123456789'),
            'role' => 'admin',
            'status' => 'active',
        ]);
    }
}
