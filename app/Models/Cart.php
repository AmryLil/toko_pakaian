<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Cart extends Model
{
    use HasFactory;

    protected $table      = 'carts_222405';
    protected $primaryKey = 'id_cart_222405';
    public $incrementing  = false;  // Penting agar Laravel tidak menganggap ID auto-increment
    protected $keyType    = 'string';  // Karena UUID adalah string

    protected $fillable = [
        'email_222405',
        'id_cart_222405'
    ];

    protected static function boot()
    {
        parent::boot();

        // Event ini akan dijalankan sebelum model dibuat (disimpan ke database untuk pertama kali)
        static::creating(function ($model) {
            // Jika id_cart_222405 belum diisi, buat UUID baru
            if (empty($model->{$model->getKeyName()})) {
                // Generate UUID dan ambil 10 karakter pertama
                $model->{$model->getKeyName()} = substr((string) Str::uuid(), 0, 10);
            }
        });
    }

    public function items()
    {
        return $this->hasMany(CartItem::class, 'id_cart_222405');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
