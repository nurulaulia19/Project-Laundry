<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->increments('id_transaksi');
            $table->integer('user_id');
            $table->integer('id_customer');
            $table->integer('id_cabang');
            $table->date('tanggal_transaksi');
            $table->date('tanggal_selesai');
            $table->integer('total_harga');
            $table->integer('total_bayar');
            $table->integer('total_kembalian');
            $table->enum('status', ['proses', 'selesai']);
            $table->integer('diskon_transaksi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
