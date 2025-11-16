<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('donasi_bencana', function (Blueprint $table) {
            $table->id('donasi_id');
            $table->unsignedBigInteger('kejadian_id'); // FK
            $table->string('donatur_nama');
            $table->string('jenis');
            $table->decimal('nilai', 15, 2)->nullable();
            $table->string('bukti')->nullable(); // file bukti donasi
            $table->timestamps();

            $table->foreign('kejadian_id')
                ->references('kejadian_id')
                ->on('kejadian_bencana')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donasi_bencana');
    }
};
