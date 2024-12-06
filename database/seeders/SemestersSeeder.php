<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Semester;
use Illuminate\Support\Facades\Hash;

class SemestersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $semesters = [
            ['semester' => 'Primero'],
            ['semester' => 'Segundo'],
            ['semester' => 'Tercero'],
            ['semester' => 'Cuarto'],
            ['semester' => 'Quinto']
        ];

        foreach($semesters as $data) {
            Semester::create($data);
        }
    }
}
