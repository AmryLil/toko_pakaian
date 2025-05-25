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
            $table->string('email_222405');
            $table->timestamps();
            $table->foreign('email_222405')->references('email_222405')->on('users_222405')->onDelete('cascade');
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
