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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('gambar')->nullable();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['Admin', 'Operator', 'User'])->default('user'); // Menetapkan role dengan enum
            $table->string('tinggi_badan')->nullable();
            $table->string('NIK')->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes(); // Untuk penghapusan sementara
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
