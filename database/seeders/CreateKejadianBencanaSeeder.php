<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KejadianBencana;

class CreateKejadianBencanaSeeder extends Seeder
{
    // public function run(): void
    // {
    //     $jenis = ['Banjir', 'Longsor', 'Kebakaran', 'Angin Puting Beliung', 'Gempa'];
    //     $status = ['Aktif', 'Selesai'];
    //     $dampak = [
    //         'Rumah Rusak',
    //         'Korban Luka',
    //         'Fasilitas Umum Rusak',
    //         'Pohon Tumbang',
    //         'Jalan Terputus',
    //         'Warga harus mencari tempat pengungsian'
    //     ];

    //     // Lokasi lebih realistis
    //     $lokasiList = [
    //         'Perumahan Cempaka Indah',
    //         'Jl. Merdeka Barat',
    //         'Desa Sukamaju',
    //         'Kampung Baru',
    //         'Komplek Melati Raya',
    //         'Dusun Harapan Jaya',
    //         'Jl. Sudirman',
    //         'Perumahan Griya Asri',
    //         'Desa Sari Murni',
    //         'Kampung Lestari',
    //         'Jl. Pramuka',
    //         'Desa Kampung Baru'
    //     ];

    //     // Keterangan natural
    //     $keteranganList = [
    //         'Tidak ada korban jiwa.',
    //         'Proses evakuasi masih dilakukan.',
    //         'Masih di lakukan pemeriksaan',
    //         'Petugas BPBD sudah berada di lokasi.',
    //         'Kerusakan cukup parah di beberapa titik.',
    //         'Warga sudah mengungsi ke lokasi aman.',
    //         'Situasi sudah mulai terkendali.',
    //         'Masih dilakukan pendataan kerusakan.',
    //     ];

    //     for ($i = 1; $i <= 100; $i++) {
    //         KejadianBencana::create([
    //             'jenis_bencana' => $jenis[array_rand($jenis)],
    //             'tanggal'       => now()->subDays(rand(1, 300)),
    //             'lokasi'        => $lokasiList[array_rand($lokasiList)],
    //             'rt'            => rand(1, 20),
    //             'rw'            => rand(1, 20),
    //             'dampak'        => $dampak[array_rand($dampak)],
    //             'status_kejadian' => $status[array_rand($status)],
    //             'keterangan'    => $keteranganList[array_rand($keteranganList)],
    //             'foto'          => null,
    //         ]);
    //     }
    // }
}
