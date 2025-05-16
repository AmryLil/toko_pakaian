<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_222405', function (Blueprint $table) {
            $table->string('id_produk_222405')->primary();
            $table->string('nama_222405');
            $table->text('deskripsi_222405');
            $table->decimal('harga_222405', 10, 2);
            $table->string('id_kategori_222405');
            $table->string('path_img_222405');
            $table->integer('jumlah_222405');
            $table->timestamp('created_at_222405')->nullable();
            $table->foreign('id_kategori_222405')->references('id_kategori_222405')->on('kategori_produk_222405')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk');
    }
}
