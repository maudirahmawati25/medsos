<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void

    {
       User::create([
        'name' => 'users',
        'email' => 'users@gmail.com',
        'password' => bcrypt('users123'),
       ]);

       User::create([
        'name' => 'admin',
        'email' => 'admin@gmail.com',
        'password' => bcrypt('admin123'),
       ]);
    }
}
