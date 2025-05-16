<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts_222405', function (Blueprint $table) {
            $table->string('id_cart_222405')->primary();
            $table->string('id_user_222405');
            $table->timestamps();
            $table->foreign('id_user_222405')->references('id_user_222405')->on('users_222405')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts_222405');
    }
}
