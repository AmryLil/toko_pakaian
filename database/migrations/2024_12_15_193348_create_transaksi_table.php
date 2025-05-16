<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_222405', function (Blueprint $table) {
            $table->string('id_transaksi_222405')->primary();
            $table->string('id_user_222405');
            $table->string('id_produk_222405');
            $table->integer('jumlah_222405');
            $table->decimal('harga_total_222405', 10, 2);
            $table->enum('status_222405', ['pending', 'dikemas', 'dikirim', 'selesai']);
            $table->string('bukti_tf_222405');
            $table->timestamp('tanggal_transaksi_222405')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->timestamps();
            $table->foreign('id_user_222405')->references('id_user_222405')->on('users_222405')->onDelete('cascade');
            $table->foreign('id_produk_222405')->references('id_produk_222405')->on('produk_222405')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
