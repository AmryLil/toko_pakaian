@extends('layouts.app')

@section('title', 'Product List')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-blue-50 pt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <!-- Modern Header Section -->
            <div class="text-center mb-12">
                <div
                    class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <h1
                    class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-gray-800 via-blue-600 to-purple-600 bg-clip-text text-transparent mb-4">
                    Our Products
                </h1>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                    Discover our curated collection of premium products crafted with excellence and innovation
                </p>

                <!-- Decorative line -->
                <div class="flex items-center justify-center mt-8 mb-12">
                    <div class="h-px bg-gradient-to-r from-transparent via-blue-300 to-transparent w-64"></div>
                    <div class="mx-4 w-2 h-2 bg-blue-500 rounded-full"></div>
                    <div class="h-px bg-gradient-to-r from-transparent via-blue-300 to-transparent w-64"></div>
                </div>
            </div>

            <!-- Filter/Search Bar (Optional Enhancement) -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-gray-100">
                <div class="flex flex-col sm:flex-row gap-4 items-center justify-between">
                    <div class="flex items-center gap-2 text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 4V2C7 1.44772 7.44772 1 8 1H16C16.5523 1 17 1.44772 17 2V4M7 4H5C3.89543 4 3 4.89543 3 6V18C3 19.1046 3.89543 20 5 20H19C20.1046 20 21 19.1046 21 18V6C21 4.89543 20.1046 4 19 4H17M7 4H17">
                            </path>
                        </svg>
                        <span class="font-medium">{{ $products->total() ?? count($products) }} Products Available</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <select
                            class="px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition-all duration-200">
                            <option>Sort by: Featured</option>
                            <option>Price: Low to High</option>
                            <option>Price: High to Low</option>
                            <option>Newest First</option>
                        </select>
                        <!-- View Toggle -->
                        <div class="flex bg-gray-100 rounded-lg p-1">
                            <button class="p-2 rounded-md bg-white shadow-sm">
                                <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                                    </path>
                                </svg>
                            </button>
                            <button class="p-2 rounded-md">
                                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            @if (!empty($products) && count($products) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-12">
                    @foreach ($products as $product)
                        <div
                            class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-blue-200 transform hover:-translate-y-2">
                            <!-- Product Image -->
                            <div class="relative overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200">
                                <img src="{{ Str::startsWith($product->path_img, 'http') ? $product->path_img : asset('storage/' . $product->path_img) }}"
                                    alt="{{ $product->nama }}"
                                    class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-700">

                                <!-- Overlay -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>

                                <!-- Quick Actions -->
                                <div
                                    class="absolute top-4 right-4 flex flex-col gap-2 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-x-2 group-hover:translate-x-0">
                                    <button
                                        class="p-2 bg-white/90 backdrop-blur-sm rounded-full shadow-lg hover:bg-white transition-all duration-200">
                                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                            </path>
                                        </svg>
                                    </button>
                                    <button
                                        class="p-2 bg-white/90 backdrop-blur-sm rounded-full shadow-lg hover:bg-white transition-all duration-200">
                                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>

                                <!-- Badge -->
                                <div class="absolute top-4 left-4">
                                    <span class="px-3 py-1 bg-blue-500 text-white text-xs font-semibold rounded-full">
                                        New
                                    </span>
                                </div>
                            </div>

                            <!-- Product Info -->
                            <div class="p-6">
                                <div class="mb-3">
                                    <h3
                                        class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-200 line-clamp-2">
                                        {{ $product->nama }}
                                    </h3>
                                    <p class="text-sm text-gray-500 mt-1">Product ID: #{{ $product->id }}</p>
                                </div>

                                <!-- Price -->
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex flex-col">
                                        <span class="text-2xl font-bold text-blue-600">
                                            IDR {{ number_format($product->harga, 0, ',', '.') }}
                                        </span>
                                        <span class="text-sm text-gray-400 line-through">
                                            IDR {{ number_format($product->harga * 1.2, 0, ',', '.') }}
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                        <span class="text-sm text-gray-600">4.5</span>
                                    </div>
                                </div>

                                <!-- Action Button -->
                                <a href="{{ route('product.show', $product->id) }}"
                                    class="block w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white text-center py-3 rounded-xl font-semibold hover:from-blue-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                    View Details
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Modern Pagination -->
                <div class="flex justify-center">
                    <div class="bg-white rounded-2xl shadow-lg p-4 border border-gray-100">
                        {{ $products->appends(['size' => request('size')])->links('vendor.pagination.tailwind') }}
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">No Products Available</h3>
                    <p class="text-gray-600 mb-8 max-w-md mx-auto">
                        We're working hard to bring you amazing products. Check back soon for updates!
                    </p>
                    <button
                        class="px-8 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-xl font-semibold hover:from-blue-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        Notify Me When Available
                    </button>
                </div>
            @endif
        </div>

        <!-- Floating Action Button -->
        <div class="fixed bottom-8 right-8 z-50">
            <button
                class="w-14 h-14 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-full shadow-2xl hover:shadow-3xl transition-all duration-300 transform hover:scale-110 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                    </path>
                </svg>
            </button>
        </div>
    </div>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .shadow-3xl {
            box-shadow: 0 35px 60px -12px rgba(0, 0, 0, 0.25);
        }
    </style>
@endsection
