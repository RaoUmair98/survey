<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $indianNames = [
            'Aarav', 'Vihaan', 'Vivaan', 'Ananya', 'Diya', 'Advik', 'Aryan', 'Aaradhya', 'Ishaan', 'Kabir',
            'Riya', 'Aahana', 'Saanvi', 'Aarush', 'Neha', 'Sai', 'Arnav', 'Ayaan', 'Vedant', 'Anaya',
            'Aadhya', 'Tanishq', 'Kavya', 'Saanvi', 'Vihaan', 'Aarav', 'Avyan', 'Anvi', 'Aahana', 'Shaurya',
            'Hridhaan', 'Siddharth', 'Amaira', 'Aarush', 'Ishika', 'Aarav', 'Anika', 'Aarav', 'Prisha',
            'Aadhya', 'Aditya', 'Aarav', 'Advait', 'Aditi', 'Aarush', 'Anvi', 'Saanvi', 'Ahaan', 'Aadya',
        ];




        if (env('APP_ENV') === 'production') {
            $this->command->warn('Seeding users is not recommended in production environment.');
            return;
        }
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Delete data instead of truncating
        DB::table('users')->truncate();

        $this->command->warn('User Table Truncated!');

        // $name = $this->command->ask('Enter name for the Super Admin:');
        // $email = $this->command->ask('Enter email for the Super Admin:');
        // $password = $this->command->secret('Enter password for the Super Admin:');

        $name = "super";
        $email = "superadmin@gmail.com";
        $password = "12345678";

        // Create Super Admin
        $superAdmin = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password), // Replace 'password' with the desired password
            'role_id' => 1, // Assuming 1 is the ID for the Super Admin role
        ]);


        $this->command->info('Super Admin seeded successfully! default password :' . $password);


        $director1 = User::create([
            'name' => 'Executive Director',
            'email' => 'chirag@gmail.com',
            'password' => Hash::make($password),
            'role_id' => 2, // Executive Director
            'manager_id' => 1, // No manager for directors
        ]);

        // First, create two directors
        $director1 = User::create([
            'name' => 'Director1',
            'email' => 'priyasanchari@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 3, // Director
            'manager_id' => 1, // No manager for directors
        ]);

        $director2 = User::create([
            'name' => 'Director2',
            'email' => 'vswapin@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 3, // Director
            'manager_id' => 1, // No manager for directors
        ]);

        // Create 10 managers using director IDs
        $managers = [];
        for ($i = 0; $i < 10; $i++) {
            $manager = User::create([
                'name' => 'Manager' . ($i + 1),
                'email' => 'manager' . ($i + 1) . '@gmail.com',
                'password' => Hash::make('password'),
                'role_id' => 4, // Manager
                'manager_id' => $i % 2 == 0 ? $director1->id : $director2->id, // Alternate between two directors
            ]);
            $managers[] = $manager;
        }

        for ($i = 0; $i < 20; $i++) {
            $employee = User::create([
                'name' => $indianNames[array_rand($indianNames)],
                'email' => 'employee' . ($i + 1) . '@gmail.com',
                'password' => Hash::make('password'),
                'role_id' => 5, // Employee
                'manager_id' => $managers[$i % 10]->id, // Assign managers in a round-robin manner
            ]);
        }



        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $this->command->info('Users seeded successfully! default password : password');
    }
}
