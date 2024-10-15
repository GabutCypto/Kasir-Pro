<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksTable extends Migration
{
    public function up()
    {
        // Membuat tabel "produks" untuk menyimpan data produk
        Schema::create('produks', function (Blueprint $table) {
            $table->id(); // ID unik untuk setiap produk
            $table->string('nama_produk'); // Nama produk
            $table->text('deskripsi')->nullable(); // Deskripsi produk, opsional
            $table->decimal('harga', 10, 2); // Harga produk
            $table->integer('stok'); // Jumlah stok produk
            $table->integer('stok_minimal')->default(10); // Batas stok minimal untuk notifikasi stok rendah
            $table->timestamps(); // Tanggal pembuatan dan pembaruan data
        });
    }

    public function down()
    {
        // Menghapus tabel "produks" jika diperlukan rollback
        Schema::dropIfExists('produks');
    }
}