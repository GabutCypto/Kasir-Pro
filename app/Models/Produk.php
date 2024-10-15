<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    // Properti yang bisa diisi secara massal
    protected $fillable = [
        'nama_produk',
        'deskripsi',
        'harga',
        'stok',
        'stok_minimal',
    ];

    // Metode untuk mengecek apakah stok produk di bawah batas stok minimal
    public function stokRendah()
    {
        return $this->stok <= $this->stok_minimal;
    }
}