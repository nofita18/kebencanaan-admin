<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id('media_id');

            // struktur baru (untuk banyak tipe file)
            $table->string('ref_table');
            $table->unsignedBigInteger('ref_id');

            $table->string('file_path');
            $table->string('mime_type')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
