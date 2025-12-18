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
        Schema::create('logistik_bencana', function (Blueprint $table) {
            $table->id('logistik_id');       // PK
            $table->unsignedBigInteger('kejadian_id'); // FK nanti
            $table->string('nama_barang');
            $table->string('satuan', 50);
            $table->integer('stok');
            $table->string('sumber')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // foreign key (opsional dulu kalau tabel kejadian_bencana ada)
            $table->foreign('kejadian_id')->references('kejadian_id')->on('kejadian_bencana')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logistik_bencana');
    }
};
