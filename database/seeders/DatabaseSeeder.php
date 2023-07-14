<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Classroom;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ClassroomSeeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\Topic::factory(2)->create([
        //     'classroom_id' => 2 ,
        //     'user_id' => 2,
        // ]);

        $this->call([
            // UserSeeder::class,
            // ClassroomSeeder::class,
        ]);
    }
}
