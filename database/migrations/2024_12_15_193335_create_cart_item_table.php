<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items_222405', function (Blueprint $table) {
            $table->string('id_cart_item_222405')->primary();
            $table->string('id_cart_222405');
            $table->string('id_produk_222405');
            $table->integer('quantity_222405');
            $table->decimal('price_222405', 10, 2);
            $table->timestamps();
            $table->foreign('id_cart_222405')->references('id_cart_222405')->on('carts_222405')->onDelete('cascade');
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
        Schema::dropIfExists('cart_items_222405');
    }
}
