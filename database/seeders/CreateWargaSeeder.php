<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CreateWargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 100; $i++) {
            DB::table('warga')->insert([
                'nama' => $faker->name(),
                'alamat' => $faker->address(),
                'rt' => str_pad(rand(1, 10), 2, '0', STR_PAD_LEFT),
                'rw' => str_pad(rand(1, 10), 2, '0', STR_PAD_LEFT),
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'no_hp' => $faker->numerify('08##########'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
