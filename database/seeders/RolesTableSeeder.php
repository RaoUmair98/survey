<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Delete data instead of truncating
        DB::table('roles')->truncate();

        $this->command->warn('Old Roles Deleted!');
        $roles = [
            ['role_name' => 'Super Admin', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['role_name' => 'Executive Director', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['role_name' => 'Director', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['role_name' => 'Manager', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['role_name' => 'Employee', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        // Insert roles into the database
        DB::table('roles')->insert($roles);

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $this->command->info('Roles seeded successfully!');
       

    }
}
