<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = [
            ['name' => 'admin', 'email' => 'k_zack004@hotmail.com', 'password' => Hash::make('123456789'), 'id_role' => 1],
            ['name' => 'guest', 'email' => 'moro_g1@hotmail.com', 'password' => Hash::make('123456789'), 'id_role' => 2]
        ];

        foreach($users as $data) {
            User::create($data);
        }
    }
}
