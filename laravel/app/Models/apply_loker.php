<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class apply_loker extends Model
{
    use HasFactory;

    protected $table = 'queue_applicant'; // Nama tabel di database
    protected $fillable = [
        'id_lowongan',
        'id_pelamar',
        'nama_lengkap',
        'email',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'NIK',
        'no_hp',
        'file_cv',
        'status',
    ];
    // protected $guarded = []; // Menggunakan guarded untuk mengizinkan semua kolom kecuali yang disebutkan

    public function user()
    {
        return $this->belongsTo(User::class, 'id_pelamar');
    }

    public function loker()
    {
        return $this->belongsTo(Loker::class, 'id_lowongan');
    }

    public function pelamar()
    {
        return $this->belongsTo(User::class, 'id_pelamar');
    }
    public function job()
    {
        return $this->belongsTo(\App\Models\Loker::class, 'id_lowongan');
    }
}
