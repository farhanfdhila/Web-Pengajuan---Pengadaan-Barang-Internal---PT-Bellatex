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
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@bellatex.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Approval User',
            'email' => 'approval@bellatex.com',
            'password' => bcrypt('password'),
            'role' => 'approval',
        ]);

        User::create([
            'name' => 'Karyawan User',
            'email' => 'karyawan@bellatex.com',
            'password' => bcrypt('password'),
            'role' => 'karyawan',
        ]);
    }
}
