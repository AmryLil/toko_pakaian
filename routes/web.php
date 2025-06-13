<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

// Halaman utama
Route::get('/', [ProductController::class, 'Best4Product'])->name('product.best');

// Login dan Logout
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Signup
Route::get('/signup', [SignupController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [SignupController::class, 'signup'])->name('signup');

// Produk dan Kategori
Route::get('/shop', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{id}', [ProductController::class, 'showUser'])->name('product.show');
// Route::get('/product/{id}', [ProductDetailsController::class, 'showProductDetails'])->name('product.show');
Route::get('/kategori', [KategoriController::class, 'index'])->name('categories');
Route::get('/kategori/{id}', [KategoriController::class, 'show'])->name('categories.show');

Route::view('/contact-us', 'pages.users.kontak')->name('contact_us');
Route::view('/about', 'pages.users.about_us')->name('about');

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
    // Route::post('/pesanan/{id}/update-status', [TransaksiController::class, 'updateStatusByUser'])->name('pesanan.updateStatus');
    Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');

    Route::delete('/cart/remove/{productId}', [CartController::class, 'removeFromCart'])->name('cart.remove');

    Route::patch('/cart/update/{itemId}', [CartController::class, 'updateQuantity'])->name('cart.update');

    Route::get('/riwayat', [TransaksiController::class, 'index'])->name('riwayat');
    Route::get('/pesanan', [TransaksiController::class, 'showPesanan'])->name('pesanan');

    Route::post('/checkout/{productId}', [\App\Http\Controllers\PaymentController::class, 'checkoutSingleProduct'])->name('checkout.single');

    Route::post('/submit-payment-proof', [PaymentController::class, 'store']);

    Route::put('/update-pesanan/{id}', [TransaksiController::class, 'updateStatusByUser'])->name('pesanan.updatebyuser');
});

// Dashboard untuk Admin
Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Produk di Dashboard
    Route::prefix('produk')->group(function () {
        Route::get('/', [ProductController::class, 'showProduct'])->name('dashboard.products');
        Route::get('/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/', [ProductController::class, 'store'])->name('products.store');
        Route::get('/{id}', [ProductController::class, 'show'])->name('products.show');
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    });

    // User di Dashboard
    Route::prefix('user')->group(function () {
        Route::get('/', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
        Route::get('/create', [\App\Http\Controllers\UserController::class, 'create'])->name('users.create');
        Route::post('/', [\App\Http\Controllers\UserController::class, 'store'])->name('users.store');
        Route::get('/{email}', [\App\Http\Controllers\UserController::class, 'show'])->name('users.show');
        Route::get('/{email}/edit', [\App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
        Route::put('/{email}', [\App\Http\Controllers\UserController::class, 'update'])->name('users.update');
        Route::delete('/{email}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
    });

    // Kategori di Dashboard
    Route::prefix('categories')->group(function () {
        Route::get('/', [KategoriController::class, 'kategori_dashboard'])->name('dashboard.kategori.index');
        Route::get('/tambah', [KategoriController::class, 'create'])->name('dashboard.category_products.create');
        Route::post('/', [KategoriController::class, 'store'])->name('dashboard.category_products.store');
        Route::get('/{id}/edit', [KategoriController::class, 'edit'])->name('dashboard.category_products.edit');
        Route::put('/{id}', [KategoriController::class, 'update'])->name('dashboard.category_products.update');
        Route::delete('/{id}', [KategoriController::class, 'destroy'])->name('dashboard.category_products.destroy');
    });

    // Transaksi di Dashboard
    Route::prefix('transaksi')->group(function () {
        Route::get('/', [TransaksiController::class, 'showAll'])->name('admin.transaksi.index');
        Route::put('/{id}/update-status', [TransaksiController::class, 'updateStatus'])->name('admin.transaksi.updateStatus');
        Route::get('/laporan', [TransaksiController::class, 'showAllLaporan'])->name('admin.transaksi.laporan');
        Route::get('/pdf/{filter}', [TransaksiController::class, 'generatePdf'])->name('admin.transaksi.pdf');
        Route::delete('/{id}', [TransaksiController::class, 'destroy'])->name('admin.transaksi.destroy');
    });
});
