<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Produk;
use App\Models\Promosi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    // Membuat transaksi baru
    public function store(Request $request)
    {
        // Validasi input transaksi
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'kuantitas' => 'required|integer|min:1',
            'kode_promo' => 'nullable|string',
            'metode_pembayaran' => 'required|string',
        ]);

        // Mendapatkan produk berdasarkan ID
        $produk = Produk::findOrFail($request->produk_id);

        // Menghitung total harga sebelum diskon
        $totalHarga = $produk->harga * $request->kuantitas;

        // Cek apakah kode promo valid
        if ($request->has('kode_promo')) {
            $promosi = Promosi::where('kode_promo', $request->kode_promo)->first();

            if ($promosi && $promosi->isActive()) {
                // Mengurangi total harga dengan diskon dari kode promo
                $totalHarga -= $promosi->nilai_diskon;
            } else {
                return response()->json(['message' => 'Kode promo tidak valid atau sudah kadaluarsa'], 400);
            }
        }

        // Mengurangi stok produk
        if ($produk->stok < $request->kuantitas) {
            return response()->json(['message' => 'Stok produk tidak mencukupi'], 400);
        }
        $produk->decrement('stok', $request->kuantitas);

        // Membuat transaksi baru
        $transaksi = Transaksi::create([
            'produk_id' => $request->produk_id,
            'kuantitas' => $request->kuantitas,
            'total_harga' => $totalHarga,
            'diskon' => $request->kode_promo ? $promosi->nilai_diskon : 0,
            'metode_pembayaran' => $request->metode_pembayaran,
        ]);

        return response()->json(['message' => 'Transaksi berhasil dibuat', 'data' => $transaksi], 201);
    }
}