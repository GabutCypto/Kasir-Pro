<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promosi extends Model
{
    use HasFactory;

    // Properti yang bisa diisi secara massal
    protected $fillable = [
        'kode_promo',
        'nilai_diskon',
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    // Memeriksa apakah promosi masih aktif
    public function isActive()
    {
        $today = now()->toDateString(); // Tanggal hari ini
        return $today >= $this->tanggal_mulai && $today <= $this->tanggal_selesai;
    }
}