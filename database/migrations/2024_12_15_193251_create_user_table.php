<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_222405', function (Blueprint $table) {
            $table->string('id_user_222405')->primary();
            $table->string('email_222405')->unique();
            $table->string('name_222405');
            $table->string('password_222405');
            $table->enum('gender_222405', ['male', 'female'])->nullable();
            $table->string('role_222405');
            $table->string('address_222405')->nullable();  // Kolom alamat, bisa kosong
            $table->string('phone_222405')->nullable();  // Kolom nomor telepon, bisa kosong
            $table->date('birth_date_222405')->nullable();  // Kolom tanggal lahir, bisa kosong
            $table->string('profile_photo_222405')->nullable();
            $table->timestamps(0);  // Menonaktifkan timestamps otomatis
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_222405');
    }
}
