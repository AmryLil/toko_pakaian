<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_produk_222405', function (Blueprint $table) {
            $table->string('id_kategori_222405')->primary();

            $table->string('nama_222405');

            $table->text('deskripsi_222405');
            $table->string('path_img_222405');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategori_produk_222405');
    }
}
