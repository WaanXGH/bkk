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
        Schema::create('relasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_p'); // Nama perusahaan
            $table->string('image_p')->nullable(); // Path gambar perusahaan
            $table->timestamps();
            $table->rememberToken();
            $table->softDeletes(); // Untuk penghapusan sementara
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relasi');
    }
};
