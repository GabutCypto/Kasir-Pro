<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    public function up()
    {
        // Membuat tabel "transaksis" untuk menyimpan data transaksi
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id(); // ID unik untuk setiap transaksi
            $table->unsignedBigInteger('produk_id'); // ID produk yang dibeli
            $table->integer('kuantitas'); // Jumlah produk yang dibeli
            $table->decimal('total_harga', 10, 2); // Total harga transaksi
            $table->decimal('diskon', 10, 2)->default(0); // Diskon yang diterapkan
            $table->string('metode_pembayaran'); // Metode pembayaran (cash, e-wallet, kartu kredit)
            $table->timestamps(); // Tanggal transaksi
            
            // Foreign key ke tabel produk
            $table->foreign('produk_id')->references('id')->on('produks')->onDelete('cascade');
        });
    }

    public function down()
    {
        // Menghapus tabel "transaksis" jika diperlukan rollback
        Schema::dropIfExists('transaksis');
    }
}