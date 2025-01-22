<?php

namespace Database\Seeders;

use App\Models\ApplicationCalls;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CallsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $calls = [
            [
                'application_title' => 'Postilacion 1',
                'start_date' => '14-01-25',
                'end_date' => '15-01-25',
                'status_call' => '1',
            ]
        ];

        foreach ($calls as $data) {
            ApplicationCalls::create($data);
        }
    }
}
