<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\KejadianBencana;
use App\Models\PoskoBencana;
use App\Models\DonasiBencana;
use App\Models\LogistikBencana;
use App\Models\DistribusiLogistik;

class KejadianLengkapSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 30; $i++) {

            // 1. KEJADIAN BENCANA
            $kejadian = KejadianBencana::create([
                'jenis_bencana'   => $faker->randomElement(['Banjir', 'Kebakaran', 'Longsor', 'Gempa', 'Puting Beliung']),
                'tanggal'         => $faker->date(),
                'lokasi'          => $faker->streetAddress() . ', ' . $faker->city(),
                'rt'              => (string) $faker->numberBetween(1, 20),
                'rw'              => (string) $faker->numberBetween(1, 20),
                'dampak'          => $faker->sentence(4),
                'status_kejadian' => $faker->randomElement(['Aktif', 'Selesai']),
                'keterangan'      => $faker->sentence(),
                'deskripsi_singkat' => $faker->sentence(8),
                'foto'            => null,
            ]);

            // 2. POSKO BENCANA (1 kejadian bisa punya beberapa posko)
            $posko = PoskoBencana::create([
                'kejadian_id'      => $kejadian->kejadian_id,
                'nama'             => 'Posko ' . ucfirst($faker->word()),
                'alamat'           => $faker->address(),
                'kontak'           => $faker->phoneNumber(),
                'penanggung_jawab' => $faker->name(),
                'foto'             => null,
            ]);

            // 3. DONASI BENCANA
            DonasiBencana::create([
                'kejadian_id'  => $kejadian->kejadian_id,
                'donatur_nama' => $faker->name(),
                'jenis'        => $faker->randomElement(['Uang', 'Makanan', 'Pakaian', 'Obat-obatan']),
                'nilai'        => $faker->randomFloat(2, 50000, 5000000),
                'bukti'        => null,
            ]);

            // 4. LOGISTIK BENCANA
            $logistik = LogistikBencana::create([
                'kejadian_id' => $kejadian->kejadian_id,
                'nama_barang' => $faker->randomElement(['Beras', 'Air Mineral', 'Selimut', 'Obat']),
                'satuan'      => $faker->randomElement(['kg', 'dus', 'pcs']),
                'stok'        => $faker->numberBetween(50, 500),
                'sumber'      => $faker->randomElement(['BNPB', 'Donatur', 'Pemda']),
                'keterangan'  => $faker->sentence(),
            ]);

            // 5. DISTRIBUSI LOGISTIK
            DistribusiLogistik::create([
                'logistik_id' => $logistik->logistik_id,
                'posko_id'    => $posko->posko_id,
                'tanggal'     => $faker->date(),
                'jumlah'      => $faker->numberBetween(5, 50),
                'penerima'    => 'Warga Terdampak',
                'keterangan'  => $faker->sentence(),
            ]);
        }
    }
}
