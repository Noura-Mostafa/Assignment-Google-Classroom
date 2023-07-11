<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        //Query Builder
        DB::table('users')->insert([
            'name' => 'Noura',
            'email' => 'nouramostafa2001@gmail.com',
            'password' => Hash::make('password'), //sha , md5 , rsa
        ]);
    }
}
