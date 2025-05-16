@extends('layouts.dashboard-layout')

@section('content')
    <div class="container mt-24 p-6 bg-white rounded-lg shadow-lg shadow-gray-200">
        <h2 class="text-3xl font-semibold mb-6 text-gray-800">Edit Product</h2>

        <!-- Pesan sukses -->
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg shadow-sm mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form Edit Produk -->
        <form action="{{ route('products.update', $product->id_produk_222405) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Nama Produk -->
            <div class="mb-6">
                <label for="nama" class="block text-gray-700 font-semibold">Product Name</label>
                <input type="text" name="nama" id="nama"
                    class="mt-1 w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('nama', $product->nama_222405) }}">
                @error('nama')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="mb-6">
                <label for="deskripsi" class="block text-gray-700 font-semibold">Description</label>
                <textarea name="deskripsi" id="deskripsi"
                    class="mt-1 w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    rows="5">{{ old('deskripsi', $product->deskripsi_222405) }}</textarea>
                @error('deskripsi')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Harga -->
            <div class="mb-6">
                <label for="harga" class="block text-gray-700 font-semibold">Price</label>
                <input type="number" name="harga" id="harga"
                    class="mt-1 w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('harga', $product->harga_222405) }}">
                @error('harga')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Jumlah Produk -->
            <div class="mb-6">
                <label for="jumlah" class="block text-gray-700 font-semibold">Stock Quantity</label>
                <input type="number" name="jumlah" id="jumlah"
                    class="mt-1 w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('jumlah', $product->jumlah_222405) }}">
                @error('jumlah')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Kategori -->
            <div class="mb-6">
                <label for="kategori_id" class="block text-gray-700 font-semibold">Category</label>
                <select name="kategori_id" id="kategori_id"
                    class="mt-1 w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id_kategori_222405 }}"
                            {{ old('kategori_id', $product->id_kategori_222405) == $category->id_kategori_222405 ? 'selected' : '' }}>
                            {{ $category->nama_222405 }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_id')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Gambar Produk -->
            <div class="mb-6">
                <label for="path_img" class="block text-gray-700 font-semibold">Product Image</label>
                <input type="file" name="path_img" id="path_img"
                    class="mt-1 w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                @if ($product->path_img_222405)
                    <img src="{{ Str::startsWith($product->path_img_222405, 'http') ? $product->path_img_222405 : asset('storage/' . $product->path_img_222405) }}"
                        alt="Current Image" class="mt-2 h-32 rounded-lg shadow-md">
                @else
                    <p class="text-gray-500 mt-2">No image available.</p>
                @endif
                @error('path_img')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <!-- Tombol Submit -->
            <div class="flex items-center justify-between mt-6">
                <a href="{{ route('dashboard.products') }}" class="text-gray-600 hover:text-gray-800">
                    <button type="button"
                        class="bg-gray-300 text-gray-800 py-2 px-6 rounded-lg hover:bg-gray-400 transition duration-200">
                        Back to List
                    </button>
                </a>
                <button type="submit"
                    class="bg-blue-500 text-white py-2 px-6 rounded-lg hover:bg-blue-600 transition duration-200">
                    Update Product
                </button>
            </div>
        </form>
    </div>
@endsection
