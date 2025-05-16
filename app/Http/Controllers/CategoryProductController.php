<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;  // Mengimpor model CategoryProduct
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryProductController extends Controller
{
    public function index()
    {
        $categories = CategoryProduct::all();
        return view('pages.users.category', compact('categories'));
    }

    public function kategori_dashboard()
    {
        $categories = CategoryProduct::all();
        return view('pages.admin.kategori.index', compact('categories'));
    }

    public function create()
    {
        return view('pages.admin.kategori.add');
    }

    public function store(Request $request)
    {
        $fileName = null;
        if ($request->hasFile('path_img_222405')) {
            $image    = $request->file('path_img_222405');
            $fileName = $image->store('images', 'public');
        }

        try {
            CategoryProduct::create([
                'id_kategori_222405' => (string) Str::uuid(),  // Generate UUID for the primary key
                'nama_222405'        => $request->input('nama_222405'),
                'deskripsi_222405'   => $request->input('deskripsi_222405'),
                'path_img_222405'    => $fileName
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan kategori:', ['error' => $e->getMessage()]);
            abort(500, 'Gagal menyimpan kategori.');
        }

        // Redirect jika berhasil
        return redirect()->route('dashboard.kategori.index')->with('success', 'Kategori berhasil disimpan!');
    }

    public function show($id)
    {
        $category = CategoryProduct::with('products')->findOrFail($id);

        return view('productbycategory', compact('category'));
    }

    public function edit($id)
    {
        $category = CategoryProduct::findOrFail($id);
        return view('pages.admin.kategori.update', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = CategoryProduct::findOrFail($id);

        if ($request->hasFile('path_img_222405')) {
            if ($category->path_img_222405 && !filter_var($category->path_img_222405, FILTER_VALIDATE_URL)) {
                if (Storage::exists('public/' . $category->path_img_222405)) {
                    Storage::delete('public/' . $category->path_img_222405);
                }
            }

            $path                      = $request->file('path_img_222405')->store('images', 'public');
            $category->path_img_222405 = $path;
        }
        try {
            $category->nama_222405      = $request->input('nama_222405');
            $category->deskripsi_222405 = $request->input('deskripsi_222405');
            $category->save();
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan kategori:', ['error' => $e->getMessage()]);
            abort(500, 'Gagal menyimpan kategori.');
        }

        // Redirect jika berhasil
        return redirect()->route('dashboard.kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $category = CategoryProduct::findOrFail($id);
        $category->delete();

        return redirect()->route('dashboard.kategori.index')->with('success', 'Category product deleted successfully.');
    }
}
