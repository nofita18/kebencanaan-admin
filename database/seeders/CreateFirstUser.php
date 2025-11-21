<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateFirstUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User utama (tetap)
        User::create([
            'name' => 'nopi',
            'email' => 'example@gmail.com',
            'password' => Hash::make('password123'),
            'remember_token' => Str::random(10),
        ]);

        // Tambahin 100 user random
        $faker = \Faker\Factory::create('id_ID');

        for ($i = 0; $i < 100; $i++) {
            User::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->email(),
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
