<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::paginate(15);

        if ($request->has('page')) {
            return view('list_product', compact('products'));
        }

        $productsLaris = Product::skip(10)->take(10)->get();
        return view('pages.users.toko', compact('products', 'productsLaris'));
    }

    public function paginate(Request $request)
    {
        $size     = $request->query('size', 12);  // Default 12 produk per halaman
        $products = Product::paginate($size);

        return view('list_product', compact('products'));
    }

    public function Best4Product(Request $request)
    {
        $products = Product::limit(4)->get();
        return view('pages.users.home', compact('products'));
    }

    public function showProduct()
    {
        $products = Product::with('category')->get();

        return view('pages.admin.produk.index', [
            'title'    => 'Daftar Produk',
            'products' => $products
        ]);
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('pages.admin.produk.show', compact('product'));
    }

    public function create()
    {
        $categories = CategoryProduct::all();

        return view('pages.admin.produk.add', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validasi input yang masuk
        $request->validate([
            'nama'        => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'harga'       => 'required|numeric',
            'jumlah'      => 'required|integer',
            'kategori_id' => 'required|integer',
            'path_img'    => 'required|image|mimes:jpeg,png,jpg,gif',  // Validasi file gambar
        ]);

        // Menangani pengunggahan gambar
        $imagePath = null;
        if ($request->hasFile('path_img')) {
            $image     = $request->file('path_img');
            $imagePath = $image->store('product_images', 'public');  // Menyimpan gambar di folder 'public/product_images'
        }

        // Menyimpan data produk ke database dengan field yang sesuai model baru
        Product::create([
            'id_produk_222405'   => Str::uuid()->toString(),  // Generate UUID untuk primary key
            'nama_222405'        => $request->input('nama'),
            'deskripsi_222405'   => $request->input('deskripsi'),
            'harga_222405'       => $request->input('harga'),
            'jumlah_222405'      => $request->input('jumlah'),
            'id_kategori_222405' => $request->input('kategori_id'),
            'path_img_222405'    => $imagePath ?? null,  // Menyimpan path gambar
            'created_at_222405'  => Carbon::now()  // Set created_at
        ]);

        return redirect()->route('dashboard.products');
    }

    public function edit($id)
    {
        $product    = Product::findOrFail($id);
        $categories = CategoryProduct::all();

        return view('pages.admin.produk.update', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($request->hasFile('path_img')) {
            if ($product->path_img_222405 && Storage::exists('public/' . $product->path_img_222405)) {
                Storage::delete('public/' . $product->path_img_222405);
            }

            $path                     = $request->file('path_img')->store('images', 'public');
            $product->path_img_222405 = $path;
        }

        $product->nama_222405        = $request->input('nama');
        $product->deskripsi_222405   = $request->input('deskripsi');
        $product->harga_222405       = $request->input('harga');
        $product->id_kategori_222405 = $request->input('kategori_id');
        $product->jumlah_222405      = $request->input('jumlah');

        try {
            $product->save();
        } catch (\Exception $e) {
            Log::error('Failed to update product: ' . $e->getMessage());
        }

        return redirect()->route('dashboard.products')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('dashboard.products')->with('success', 'Product deleted successfully.');
    }
}
