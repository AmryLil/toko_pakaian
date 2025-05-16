<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $table      = 'cart_items_222405';
    protected $primaryKey = 'id_cart_item_222405';
    public $incrementing  = false;  // Penting agar Laravel tidak menganggap ID auto-increment
    protected $keyType    = 'string';  // Karena UUID adalah string

    protected $fillable = [
        'id_cart_222405',
        'id_produk_222405',
        'quantity_222405',
        'price_222405'
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'id_cart_222405');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_produk_222405');
    }
}
