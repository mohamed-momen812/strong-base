<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleAndPermissionSeedr::class);
        $this->call(AdminSeeder::class);
        $this->call(UserSeeder::class);
    }
}
