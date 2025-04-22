<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relasi extends Model
{
    use HasFactory;

    protected $table = 'relasi'; // Nama tabel di database

    protected $fillable = [
        'nama_p',
        'image_p',
    ];

    protected $hidden = [
        'id',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    // Mendapatkan URL gambar
    public function getImageUrlAttribute()
    {
        return $this->image_p ? asset('storage/' . $this->image_p) : null;
    }
}
