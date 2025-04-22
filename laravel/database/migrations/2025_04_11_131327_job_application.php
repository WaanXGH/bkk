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
        Schema::create('queue_applicant', function (Blueprint $table) {


            $table->unsignedBigInteger('id_pelamar');
            $table->foreign('id_pelamar')->references('id')->on('users')->onDelete('cascade');
            $table->id(); // ID pelamar
            $table->unsignedBigInteger('id_lowongan'); // foreign key ke tabel loker
            $table->foreign('id_lowongan')->references('id')->on('loker')->onDelete('cascade');

            $table->string('nama_lengkap');
            $table->string('id_lowongan'); // ID lowongan pekerjaan
            $table->string('email'); // Email pelamar
            $table->string('NIK')->nullable(); // Nomor KTP (opsional)
            $table->string('tempat_lahir')->nullable(); // Tempat lahir (opsional)
            $table->date('tanggal_lahir')->nullable(); // Tanggal lahir (opsional)
            $table->string('alamat')->nullable(); // Alamat (opsional)
            $table->string('jenis_kelamin')->nullable(); // Jenis kelamin (opsional)
            $table->string('no_hp')->nullable(); // Nomor HP (opsional)
            $table->string('file_cv')->nullable(); // Path file CV yang diunggah
            $table->text('surat_lamaran')->nullable(); // Surat lamaran kerja
            $table->enum('status', ['menunggu', 'diproses', 'diterima', 'ditolak'])->default('menunggu'); // Status lamaran
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queue_applicant');
        Schema::table('queue_applicant', function (Blueprint $table) {
            $table->dropColumn('id_loker');
        });
    }
};
