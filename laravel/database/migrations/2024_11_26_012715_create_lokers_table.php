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
        Schema::create('lokers', function (Blueprint $table) {
            $table->id();
            $table->string('gambar')->nullable(); // Kolom untuk gambar
            $table->string('judul'); // judul teks pelamar
            $table->text('detail_s')->nullable(); //detail singkat
            $table->text('detail')->nullable();
            $table->text('alamat')->nullable();
            $table->integer('jobdesk')->nullable(); // Kolom untuk detail lowongan
            $table->integer('max_pelamar')->nullable(); // Kolom untuk maksimal pelamar
            $table->date('tanggal_mulai')->nullable(); // Kolom untuk tanggal awal penerimaan
            $table->date('tanggal_selesai')->nullable();
            $table->integer('gaji_terendah')->nullable();
            $table->integer('gaji_tertinggi')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lokers');
    }
};
