<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
         // Disable foreign key checks
         DB::statement('SET FOREIGN_KEY_CHECKS=0');

         // Delete data instead of truncating
         DB::table('permissions')->truncate();
         $this->command->warn('Old permissions Deleted!');
        
        // Define permissions data
        $permissions = [
            ['permission_name' => 'create employee'],
            ['permission_name' => 'edit employee'],
            ['permission_name' => 'delete employee'],
            ['permission_name' => 'update employee'],
            ['permission_name' => 'create manager'],
            ['permission_name' => 'edit manager'],
            ['permission_name' => 'delete manager'],
            ['permission_name' => 'update manager'],
            ['permission_name' => 'create director'],
            ['permission_name' => 'edit director'],
            ['permission_name' => 'delete director'],
            ['permission_name' => 'update director'],
            ['permission_name' => 'assign roles (manager)'],
            ['permission_name' => 'assign roles (employee)'],
            ['permission_name' => 'assign roles (director)'],
            ['permission_name' => 'create survey'],
            ['permission_name' => 'send survey'],
            ['permission_name' => 'delete survey'],
            ['permission_name' => 'view survey'],
            ['permission_name' => 'view notes'],
            ['permission_name' => 'edit notes'],
            ['permission_name' => 'delete notes'],
            ['permission_name' => 'create email template'],
            ['permission_name' => 'edit email template'],
            ['permission_name' => 'delete email template'],
            ['permission_name' => 'update email template'],
        ];

        // Insert permissions into the database
        DB::table('permissions')->insert($permissions);

        $this->command->info('Permissions seeded successfully!');
    }
}
