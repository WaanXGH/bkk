<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loker extends Model
{
    use HasFactory;

    protected $table = 'lokers'; // Nama tabel di database
    protected $fillable = [
        'gambar',
        'judul',
        'detail',
        'detail_s',
        'gaji_terendah',
        'gaji_tertinggi',
        'max_pelamar',
        'tanggal_mulai',
        'tanggal_selesai',
        'jobdesk',
        'alamat',
    ];
    // protected $guarded = []; // Menggunakan guarded untuk mengizinkan semua kolom kecuali yang disebutkan

    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail ? asset('storage/' . $this->thumbnail) : null;
    }

    public function pelamars()
    {
        return $this->hasMany(apply_loker::class, 'id_lowongan');
    }
}
