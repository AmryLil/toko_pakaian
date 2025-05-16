<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table      = 'users_222405';
    protected $primaryKey = 'id_user_222405';
    public $incrementing  = false;  // Penting agar Laravel tidak menganggap ID auto-increment
    protected $keyType    = 'string';  // Karena UUID adalah string

    public function getAuthIdentifierName()
    {
        return 'id_user_222405';
    }

    public function getAuthPassword()
    {
        return $this->password_222405;
    }

    public $timestamps = false;

    protected $fillable = [
        'id_user_222405',
        'email_222405', 'name_222405', 'password_222405', 'role_222405', 'gender_222405', 'address_222405', 'phone_222405', 'birth_date_222405', 'profile_photo_222405'
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_user_222405', 'id_user_222405');
    }
}
