<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // Menampilkan semua produk yang tersedia
    public function index()
    {
        $produks = Produk::all(); // Mengambil semua data produk
        return response()->json($produks); // Mengembalikan dalam format JSON
    }

    // Menambahkan produk baru
    public function store(Request $request)
    {
        // Validasi input untuk memastikan data yang masuk benar
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'stok_minimal' => 'required|integer',
        ]);

        // Menyimpan data produk baru
        $produk = Produk::create($request->all());

        // Cek apakah stok produk rendah
        if ($produk->stokRendah()) {
            return response()->json(['message' => 'Produk berhasil ditambahkan, namun stok rendah!', 'data' => $produk], 201);
        }

        return response()->json(['message' => 'Produk berhasil ditambahkan', 'data' => $produk], 201);
    }

    // Menampilkan detail satu produk berdasarkan ID
    public function show($id)
    {
        $produk = Produk::findOrFail($id); // Mengambil produk berdasarkan ID
        return response()->json($produk); // Mengembalikan data produk
    }

    // Memperbarui data produk
    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id); // Mencari produk berdasarkan ID

        // Validasi input untuk memastikan data yang masuk benar
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'stok_minimal' => 'required|integer',
        ]);

        // Memperbarui data produk
        $produk->update($request->all());

        // Cek apakah stok produk rendah setelah update
        if ($produk->stokRendah()) {
            return response()->json(['message' => 'Produk berhasil diupdate, namun stok rendah!', 'data' => $produk]);
        }

        return response()->json(['message' => 'Produk berhasil diupdate', 'data' => $produk]);
    }

    // Menghapus produk
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id); // Mencari produk berdasarkan ID
        $produk->delete(); // Menghapus produk

        return response()->json(['message' => 'Produk berhasil dihapus']);
    }
}