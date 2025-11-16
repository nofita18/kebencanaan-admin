<?php

namespace Database\Seeders;

use App\Models\DonasiBencana;
use App\Models\KejadianBencana;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateKejadianDonasi extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kejadian = KejadianBencana::create([
            'jenis_bencana'  => 'Banjir',
            'tanggal'        => '2025-01-10',
            'lokasi'         => 'RT 02 / RW 05 Desa Sukamaju',
            'rt'             => '02',
            'rw'             => '05',
            'dampak'         => 'Puluhan rumah terendam',
            'status_kejadian'=> 'aktif',
            'keterangan'     => 'Curah hujan tinggi.',
            'foto'           => null,
        ]);

        DonasiBencana::create([
            'kejadian_id'  => $kejadian->kejadian_id,   // Relasi
            'donatur_nama' => 'PT Sumber Jaya',
            'jenis'        => 'Uang Tunai',
            'nilai'        => 5000000,
            'bukti'        => null,
        ]);
    }
}
