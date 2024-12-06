<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Institucion;
use Illuminate\Support\Facades\Hash;

class InstitutesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Institucion::create([
            'name' => 'Institución Ficticia',
            'address' => 'Address',
            'user_limit' => '2',
        ]);
    }
}
