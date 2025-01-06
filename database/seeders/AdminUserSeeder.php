<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = [
            ['name' => 'admin', 'email' => 'k_zack004@hotmail.com', 'password' => Hash::make('123456789'), 'role' => 'admin'],
            ['name' => 'guest', 'email' => 'moro_g1@hotmail.com', 'password' => Hash::make('123456789'), 'role' => 'user']
        ];

        foreach($users as $data) {
            User::create($data);
        }
    }
}
