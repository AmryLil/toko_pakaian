<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CartItem extends Model
{
    use HasFactory;

    protected $table      = 'cart_items_222405';
    protected $primaryKey = 'id_cart_item_222405';
    public $incrementing  = false;  // Penting agar Laravel tidak menganggap ID auto-increment
    protected $keyType    = 'string';  // Karena UUID adalah string

    protected $fillable = [
        'id_cart_item_222405',
        'id_cart_222405',
        'id_produk_222405',
        'quantity_222405',
        'price_222405'
    ];

    protected static function boot()
    {
        parent::boot();

        // Event ini akan dijalankan sebelum model dibuat (disimpan ke database untuk pertama kali)
        static::creating(function ($model) {
            // Jika id_cart_item_222405 belum diisi, buat UUID baru
            if (empty($model->{$model->getKeyName()})) {
                // Generate UUID dan ambil 10 karakter pertama
                $model->{$model->getKeyName()} = substr((string) Str::uuid(), 0, 10);
            }
        });
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'id_cart_222405');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_produk_222405');
    }
}
