<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    // Method untuk menampilkan semua transaksi
    public function index()
    {
        $transaksi = Transaksi::where('id_user_222405', Auth::id())->get();
        return response()->json($transaksi);
    }

    // Method untuk menampilkan transaksi berdasarkan ID
    public function show($id)
    {
        $transaksi = Transaksi::find($id);
        if (!$transaksi) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }
        return response()->json($transaksi);
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'receipt' => 'required|image|max:2048',
        ]);

        // Ambil data pengguna yang sedang login dari session
        $userId = session('user_id');

        // Debugging: Log user_id
        Log::debug('User ID from session: ' . $userId);

        if (!$userId) {
            return response()->json(['message' => 'Pengguna tidak ditemukan'], 403);
        }

        // Ambil data keranjang berdasarkan user_id
        $cart = Cart::where('id_user_222405', $userId)->first();

        // Debugging: Log cart data
        Log::debug('Cart data: ' . json_encode($cart));

        if (!$cart) {
            return response()->json(['message' => 'Keranjang belanja tidak ditemukan'], 404);
        }

        // Ambil item dari tabel CartItem berdasarkan cart_id
        $cartItems = CartItem::where('id_cart_222405', $cart->id_cart_222405)->get();

        // Debugging: Log cart items
        Log::debug('Cart Items: ' . json_encode($cartItems));

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Keranjang belanja kosong'], 400);
        }

        $totalPrice    = 0;
        $totalQuantity = 0;

        try {
            $path = $request->file('receipt')->store('bukti_transfer', 'public');

            // Debugging: Log file path
            Log::debug('File path: ' . $path);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menyimpan bukti transfer', 'error' => $e->getMessage()], 500);
        }

        // Proses transaksi dan pengurangan stok produk
        foreach ($cartItems as $item) {
            $product = $item->product;

            // Debugging: Log product data
            Log::debug('Processing product: ' . json_encode($product));

            if (!$product) {
                return response()->json(['message' => 'Produk dengan ID ' . $item->id_produk_222405 . ' tidak ditemukan'], 404);
            }

            // Periksa apakah stok cukup
            if ($product->jumlah_222405 < $item->quantity_222405) {
                return response()->json(['message' => 'Stok produk ' . $product->nama_222405 . ' tidak mencukupi'], 400);
            }

            // Hitung total harga dan jumlah
            $totalPrice    += $product->harga_222405 * $item->quantity_222405;
            $totalQuantity += $item->quantity_222405;

            // Kurangi stok produk
            $product->jumlah_222405 -= $item->quantity_222405;
            $product->save();

            // Buat transaksi baru
            Transaksi::create([
                'id_transaksi_222405'      => (string) Str::uuid(),
                'id_user_222405'           => $userId,
                'jumlah_222405'            => $item->quantity_222405,
                'id_produk_222405'         => $product->id_produk_222405,
                'harga_total_222405'       => $product->harga_222405 * $item->quantity_222405,
                'status_222405'            => 'pending',
                'bukti_tf_222405'          => $path,
                'tanggal_transaksi_222405' => Carbon::now(),
            ]);

            // Debugging: Log transaction data
            Log::debug('Transaction created for product: ' . $product->id_produk_222405 . ' with total price: ' . $product->harga_222405 * $item->quantity_222405);
        }

        // Kosongkan keranjang setelah checkout berhasil
        CartItem::where('id_cart_222405', $cart->id_cart_222405)->delete();

        // Hapus keranjang jika sudah kosong
        $cart->delete();

        // Debugging: Log cart cleared
        Log::debug('Cart cleared for user ID: ' . $userId);

        return response()->json(['message' => 'Pembayaran berhasil disimpan', 'data' => 'success'], 201);
    }

    // Method untuk mengupdate status transaksi (misalnya oleh admin)
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);
        if (!$transaksi) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        // Update status transaksi
        $transaksi->update(['status_222405' => $validated['status']]);

        return response()->json(['message' => 'Status transaksi diperbarui', 'data' => $transaksi]);
    }

    // Method untuk menghapus transaksi
    public function destroy($id)
    {
        $transaksi = Transaksi::find($id);
        if (!$transaksi) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        // Hapus file bukti transfer jika ada
        if ($transaksi->bukti_tf_222405) {
            Storage::disk('public')->delete($transaksi->bukti_tf_222405);
        }

        $transaksi->delete();

        return redirect()->back()->with('success', 'Transaksi berhasil dihapus.');
    }

    public function checkoutSingleProduct(Request $request, $productId)
    {
        // Validasi input untuk bukti transfer
        $validated = $request->validate([
            'receipt'  => 'required|image|max:2048',  // Bukti transfer wajib berupa gambar
            'quantity' => 'required|integer|min:1'  // Jumlah produk yang dibeli
        ]);

        // Ambil pengguna dari session
        $userId = session('user_id');

        if (!$userId) {
            return response()->json(['message' => 'Pengguna tidak ditemukan'], 403);
        }

        // Ambil data produk berdasarkan ID
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        // Periksa apakah stok mencukupi
        if ($product->jumlah_222405 < $validated['quantity']) {
            return response()->json(['message' => 'Stok produk tidak mencukupi'], 400);
        }

        // Simpan bukti transfer
        try {
            $path = $request->file('receipt')->store('bukti_transfer', 'public');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menyimpan bukti transfer', 'error' => $e->getMessage()], 500);
        }

        // Kurangi stok produk
        $product->jumlah_222405 -= $validated['quantity'];
        $product->save();

        // Buat transaksi baru
        $transaksi = Transaksi::create([
            'id_transaksi_222405'      => (string) Str::uuid(),
            'id_user_222405'           => $userId,
            'jumlah_222405'            => $validated['quantity'],
            'id_produk_222405'         => $product->id_produk_222405,
            'harga_total_222405'       => $product->harga_222405 * $validated['quantity'],
            'status_222405'            => 'pending',
            'bukti_tf_222405'          => $path,
            'tanggal_transaksi_222405' => Carbon::now(),
        ]);

        return response()->json([
            'message'   => 'Checkout berhasil',
            'transaksi' => $transaksi
        ], 201);
    }
}
