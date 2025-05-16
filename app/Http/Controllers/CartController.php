<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CartController extends Controller
{
    // Fungsi untuk menambahkan item ke dalam cart
    public function addToCart(Request $request, $productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $userId = session('id_user_222405');

        // Find or create cart using the correct field names
        $cart = Cart::firstOrCreate(
            ['id_user_222405' => $userId],
            ['id_cart_222405' => Str::uuid()->toString()]
        );

        // Check if product is already in cart
        $cartItem = $cart->items()->where('id_produk_222405', $productId)->first();

        if ($cartItem) {
            // Update quantity if product already exists in cart
            $cartItem->quantity_222405 += $request->input('quantity', 1);
            $cartItem->save();
        } else {
            // Add new item to cart with UUID
            $cart->items()->create([
                'id_cart_item_222405' => Str::uuid()->toString(),
                'id_cart_222405'      => $cart->id_cart_222405,
                'id_produk_222405'    => $product->id_produk_222405,
                'quantity_222405'     => $request->input('quantity', 1),
                'price_222405'        => $product->harga_222405
            ]);
        }

        return response()->json(['message' => 'Product added to cart successfully'], 200);
    }

    public function showCart()
    {
        $userId = session('id_user_222405');

        // Get cart with items using correct field names and relationships
        $cart = Cart::where('id_user_222405', $userId)->first();

        if (!$cart) {
            return view('pages.users.cart', ['cartItems' => collect()]);
        }

        // Load cart items with their products
        $cartItems = $cart->items()->with('product')->get();

        return view('pages.users.cart', ['cartItems' => $cartItems]);
    }

    // Fungsi untuk melihat isi cart
    public function viewCart()
    {
        $userId = session('id_user_222405');
        $cart   = Cart::where('id_user_222405', $userId)->first();

        if (!$cart) {
            return response()->json(['message' => 'Cart is empty'], 200);
        }

        // Load items with products
        $cartItems = $cart->items()->with('product')->get();

        return response()->json([
            'cart_id' => $cart->id_cart_222405,
            'items'   => $cartItems->map(function ($item) {
                return [
                    'product_id'   => $item->id_produk_222405,
                    'product_name' => $item->product->nama_222405,
                    'quantity'     => $item->quantity_222405,
                    'price'        => $item->price_222405,
                    'subtotal'     => $item->quantity_222405 * $item->price_222405,
                ];
            })
        ], 200);
    }

    public function removeFromCart(Request $request, $productId)
    {
        $userId = session('id_user_222405');
        $cart   = Cart::where('id_user_222405', $userId)->first();

        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 404);
        }

        // Find cart item using correct field names
        $cartItem = $cart->items()->where('id_produk_222405', $productId)->first();

        if ($cartItem) {
            $cartItem->delete();
            return response()->json(['message' => 'Product removed from cart successfully']);
        } else {
            return response()->json(['message' => 'Product not found in cart'], 404);
        }
    }

    public function updateQuantity(Request $request, $itemId)
    {
        // Find cart item using the correct primary key
        $item = CartItem::find($itemId);

        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        $newQuantity = $request->input('quantity');

        // Update quantity using the correct field name
        $item->quantity_222405 = $newQuantity;
        $item->save();

        return response()->json([
            'success'      => true,
            'new_quantity' => $newQuantity,
            'subtotal'     => $newQuantity * $item->price_222405
        ]);
    }

    // Additional helpful method to get cart total
    public function getCartTotal()
    {
        $userId = session('id_user_222405');
        $cart   = Cart::where('id_user_222405', $userId)->first();

        if (!$cart) {
            return response()->json(['total' => 0], 200);
        }

        $total = $cart->items()->sum(DB::raw('quantity_222405 * price_222405'));

        return response()->json(['total' => $total], 200);
    }
}
