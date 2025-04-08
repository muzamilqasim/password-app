<?php

namespace Database\Seeders;

use Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'name' => 'Admin',
            'email' => 'a@gmail.com',
            'username' => 'admin',
            'password' => Hash::make('a1234')
        ];
        DB::table('admins')->insert($data);
    }
}
