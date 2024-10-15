<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // Properti yang bisa diisi secara massal
    protected $fillable = [
        'produk_id',
        'kuantitas',
        'total_harga',
        'diskon',
        'metode_pembayaran',
    ];

    // Relasi ke model Produk
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}