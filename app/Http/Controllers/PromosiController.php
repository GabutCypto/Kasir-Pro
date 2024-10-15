<?php

namespace App\Http\Controllers;

use App\Models\Promosi;
use Illuminate\Http\Request;

class PromosiController extends Controller
{
    // Menambahkan promosi baru
    public function store(Request $request)
    {
        $request->validate([
            'kode_promo' => 'required|string|unique:promosis,kode_promo',
            'nilai_diskon' => 'required|numeric|min:0',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $promosi = Promosi::create($request->all());

        return response()->json(['message' => 'Promosi berhasil ditambahkan', 'data' => $promosi], 201);
    }

    // Melihat semua promosi
    public function index()
    {
        $promosis = Promosi::all();
        return response()->json($promosis);
    }

    // Menghapus promosi
    public function destroy($id)
    {
        $promosi = Promosi::findOrFail($id);
        $promosi->delete();

        return response()->json(['message' => 'Promosi berhasil dihapus']);
    }
}