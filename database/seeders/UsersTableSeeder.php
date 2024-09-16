<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'email' => 'admin@simov.com',
                'password' => Hash::make('admin'),
                'created_at' => now(),
            ],
            [
                'email' => 'manager@simov.com',
                'password' => Hash::make('manager'),
                'created_at' => now(),
            ],
            [
                'email' => 'user@simov.com',
                'password' => Hash::make('user'),
                'created_at' => now(),
            ],
        ]);
    }
}
