<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Grade;
use Illuminate\Support\Facades\Hash;

class GradesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $grades = [
            ['grade' => 'A'],
            ['grade' => 'B'],
        ];

        foreach($grades as $data) {
            Grade::create($data);
        }
    }
}
