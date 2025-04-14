<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            // CallsSeeder::class,
            // InstitutesSeeder::class,
            GradesSeeder::class,
            SemestersSeeder::class,
            UsersSeeder::class,
        ]);
    }
}
