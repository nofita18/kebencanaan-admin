<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kejadian_bencana', function (Blueprint $table) {
            $table->bigIncrements('kejadian_id');
            $table->string('jenis_bencana', 100); // misal "Banjir", "Kebakaran", dst.
            $table->date('tanggal');
            $table->string('lokasi', 150); // nama lokasi atau alamat singkat
            $table->string('rt', 5);
            $table->string('rw', 5);
            $table->string('dampak', 150);         // misal "Rumah rusak", "Korban luka", dst.
            $table->string('status_kejadian', 50); // misal "Aktif", "Selesai", dst.
            $table->text('keterangan')->nullable();
            $table->string('foto', 255)->nullable(); // path foto maksimal 255 karakter
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kejadian_bencana');
    }
};
