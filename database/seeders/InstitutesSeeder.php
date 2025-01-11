<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Institute;

class InstitutesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $institutes = [
            ['name' => 'Institución 1', 'address' => 'Address 1', 'user_limit' => '3'],
            ['name' => 'Institución 2', 'address' => 'Address 2', 'user_limit' => '3'],
            ['name' => 'Institución 3', 'address' => 'Address 3', 'user_limit' => '3'],
            ['name' => 'Institución 4', 'address' => 'Address 4', 'user_limit' => '3'],
            ['name' => 'Institución 5', 'address' => 'Address 5', 'user_limit' => '3']
        ];

        foreach($institutes as $data) {
            Institute::create($data);
        }
    }
}
