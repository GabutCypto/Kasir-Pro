<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromosisTable extends Migration
{
    public function up()
    {
        // Membuat tabel "promosis" untuk menyimpan data kode promo
        Schema::create('promosis', function (Blueprint $table) {
            $table->id(); // ID unik untuk promosi
            $table->string('kode_promo')->unique(); // Kode promo yang unik
            $table->decimal('nilai_diskon', 10, 2); // Nilai diskon yang diberikan oleh kode promo
            $table->date('tanggal_mulai'); // Tanggal mulai berlaku promo
            $table->date('tanggal_selesai'); // Tanggal akhir berlaku promo
            $table->timestamps(); // Tanggal pembuatan dan pembaruan
        });
    }

    public function down()
    {
        // Menghapus tabel "promosis" jika dilakukan rollback
        Schema::dropIfExists('promosis');
    }
}