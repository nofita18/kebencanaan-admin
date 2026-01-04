<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

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
            'email' => 'pii@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('password123'),
            // 'remember_token' => Str::random(10),
        ]);

        // Tambahin 100 user random
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 100; $i++) {
            $roles = ['admin', 'staff', 'user'];

            User::create([
                'name'     => $faker->name(),
                'email'    => $faker->unique()->safeEmail(),
                'role'     => $faker->randomElement($roles),
                'password' => Hash::make('password123'),
            ]);
        }
    }
}
