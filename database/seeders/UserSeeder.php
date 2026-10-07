<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@sim-ami.ac.id',
            'password' => Hash::make('admin123'),
        ])->assignRole('Admin');

        // PJM user
        User::create([
            'name' => 'Yoga Tiara',
            'username' => 'yoga_tiara',
            'email' => 'yogatiarawiguna@gmail.com',
            'password' => Hash::make('zxcvbnm123'),
        ])->assignRole('PJM', 'Auditor', 'Auditee');
    }
}
