<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CreateKejadianDonasi extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 100; $i++) {

            // 1. KEJADIAN BENCANA
            $kejadianId = DB::table('kejadian_bencana')->insertGetId([
                'jenis_bencana'    => $faker->randomElement(['Banjir', 'Kebakaran', 'Longsor', 'Gempa', 'Puting Beliung']),
                'tanggal'          => $faker->date(),
                'lokasi'           => $faker->streetAddress() . ', ' . $faker->city(),
                'rt'               => (string) $faker->numberBetween(1, 20),
                'rw'               => (string) $faker->numberBetween(1, 20),
                'dampak'           => $faker->randomElement(['Rumah Rusak', 'Korban Luka', 'Korban Jiwa', 'Jalan Terputus', 'Fasilitas umum rusak', 'Warga harus ngungsi']),
                'status_kejadian'  => $faker->randomElement(['Aktif', 'Selesai']),
                'keterangan'       => $faker->sentence(),
                'foto'             => null,
            ]);

            // 2. POSKO BENCANA
            DB::table('posko_bencana')->insert([
                'kejadian_id'       => $kejadianId,
                'nama'              => 'Posko ' . ucfirst($faker->word()),
                'alamat'            => $faker->streetAddress(),
                'kontak'            => $faker->phoneNumber(),
                'penanggung_jawab'  => $faker->name(),
                'foto'              => null,
            ]);

            // 3. DONASI BENCANA
            DB::table('donasi_bencana')->insert([
                'kejadian_id'   => $kejadianId,
                'donatur_nama'  => $faker->name(),
                'jenis'         => $faker->randomElement(['Uang', 'Makanan', 'Pakaian', 'Obat-obatan']),
                'nilai'         => $faker->randomFloat(2, 50000, 5000000), // 50 ribu - 5 juta
                'bukti'         => null,
            ]);
        }
    }
}
