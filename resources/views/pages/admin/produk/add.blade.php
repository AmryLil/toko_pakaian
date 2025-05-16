@extends('layouts.dashboard-layout')

@section('content')
    <div class="container mx-auto pt-24">
        <form class="bg-white p-6 rounded-lg shadow-md" action="{{ route('products.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <h1 class="text-3xl font-semibold text-gray-800 mb-6">Tambah Produk</h1>

            <div class="mb-6">
                <label for="nama" class="block text-lg font-medium text-gray-700 mb-2">Nama Produk</label>
                <input type="text" name="nama"
                    class="border border-gray-300 p-3 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('nama')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-6">
                <label for="deskripsi" class="block text-lg font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea name="deskripsi"
                    class="border border-gray-300 p-3 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    rows="4"></textarea>
                @error('deskripsi')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-6">
                <label for="harga" class="block text-lg font-medium text-gray-700 mb-2">Harga</label>
                <input type="number" name="harga"
                    class="border border-gray-300 p-3 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('harga')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-6">
                <label for="jumlah" class="block text-lg font-medium text-gray-700 mb-2">Jumlah Produk</label>
                <input type="number" name="jumlah" id="jumlah"
                    class="border border-gray-300 p-3 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('jumlah')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-6">
                <label for="kategori_id" class="block text-lg font-medium text-gray-700 mb-2">Kategori
                    Produk</label>
                <select name="kategori_id"
                    class="border p-3 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id_kategori_222405 }}">{{ $category->nama_222405 }}</option>
                    @endforeach
                </select>
                @error('kategori_id')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-6">
                <label for="path_img" class="block text-lg font-medium text-gray-700 mb-2">Gambar Produk</label>
                <input type="file" name="path_img"
                    class="border border-gray-300 p-3 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('path_img')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div class="flex items-center justify-between mt-6">
                <a href="{{ route('dashboard.products') }}" class="text-gray-600 hover:text-gray-800">
                    <button type="button"
                        class="bg-gray-300 text-gray-800 py-2 px-6 rounded-lg hover:bg-gray-400 transition duration-200">
                        Back to List
                    </button>
                </a>
                <button type="submit"
                    class="bg-green-600 text-white py-3 px-6 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
@endsection
