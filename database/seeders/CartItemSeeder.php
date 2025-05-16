<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all carts and products
        $carts    = Cart::all();
        $products = Product::all();

        // Add 1-3 random products to each cart
        foreach ($carts as $cart) {
            // Randomly determine how many items to add (1-3)
            $itemCount = rand(1, 3);

            // Get random products
            $randomProducts = $products->random($itemCount);

            foreach ($randomProducts as $product) {
                // Randomly determine quantity (1-5)
                $quantity = rand(1, 5);

                CartItem::create([
                    'id_cart_item_222405' => Str::uuid()->toString(),
                    'id_cart_222405'      => $cart->id_cart_222405,
                    'id_produk_222405'    => $product->id_produk_222405,
                    'quantity_222405'     => $quantity,
                    'price_222405'        => $product->harga_222405
                ]);
            }
        }
    }
}
