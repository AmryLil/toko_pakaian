@extends('layouts.dashboard-layout')

@section('content')
    <div class="container mt-24 p-6 bg-white rounded-lg shadow-lg">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-semibold text-gray-800">Detail Produk</h2>
            <a href="{{ route('dashboard.products') }}" class="text-blue-600 hover:text-blue-800">
                <button class="bg-gray-200 text-gray-800 py-2 px-4 rounded-lg hover:bg-gray-300 transition">
                    Kembali ke Daftar
                </button>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Gambar Produk -->
            <div class="flex justify-center">
                @if ($product->path_img_222405)
                    <img src="{{ Str::startsWith($product->path_img_222405, 'http') ? $product->path_img_222405 : asset('storage/' . $product->path_img_222405) }}"
                        alt="{{ $product->nama_222405 }}" class="rounded-lg shadow-md max-h-96 object-contain">
                @else
                    <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                        <p class="text-gray-500">No image available</p>
                    </div>
                @endif
            </div>

            <!-- Detail Produk -->
            <div class="space-y-4">
                <div>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $product->nama_222405 }}</h3>
                    <p class="text-sm text-gray-500">ID: {{ $product->id_produk_222405 }}</p>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="font-semibold text-gray-700 mb-2">Kategori</h4>
                    <p>{{ $product->category->nama_222405 ?? 'Tidak ada kategori' }}</p>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="font-semibold text-gray-700 mb-2">Harga</h4>
                    <p class="text-2xl font-bold text-green-600">Rp {{ number_format($product->harga_222405, 0, ',', '.') }}
                    </p>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="font-semibold text-gray-700 mb-2">Stok</h4>
                    <p class="text-lg font-medium">{{ $product->jumlah_222405 }} unit</p>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="font-semibold text-gray-700 mb-2">Deskripsi</h4>
                    <p class="text-gray-600">{{ $product->deskripsi_222405 }}</p>
                </div>

                @if ($product->created_at_222405)
                    <div class="text-sm text-gray-500 mt-4">
                        <p>Dibuat pada: {{ \Carbon\Carbon::parse($product->created_at_222405)->format('d M Y H:i') }}</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="flex space-x-4 mt-8">
            <a href="{{ route('products.edit', $product->id_produk_222405) }}"
                class="bg-blue-500 text-white py-2 px-6 rounded-lg hover:bg-blue-600 transition duration-200">
                Edit Produk
            </a>
            <form action="{{ route('products.destroy', $product->id_produk_222405) }}" method="POST"
                onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="bg-red-500 text-white py-2 px-6 rounded-lg hover:bg-red-600 transition duration-200">
                    Hapus Produk
                </button>
            </form>
        </div>
    </div>
@endsection
