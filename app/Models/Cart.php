<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table      = 'carts_222405';
    protected $primaryKey = 'id_cart_222405';
    public $incrementing  = false;  // Penting agar Laravel tidak menganggap ID auto-increment
    protected $keyType    = 'string';  // Karena UUID adalah string

    protected $fillable = [
        'id_user_222405'
    ];

    public function items()
    {
        return $this->hasMany(CartItem::class, 'id_cart_222405');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
