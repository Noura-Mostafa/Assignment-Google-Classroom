<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClassroomSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('classrooms')->insert([
            'name' => 'Larvel Course',
            'code' => '5B3M5',
            'section' => 'Laravel',
            'status'=> 'active',
            'cover_image_path' => fake()->image(),
        ]);
    }
}
