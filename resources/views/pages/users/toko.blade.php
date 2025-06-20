@extends('layouts.app')

@section('title', 'Toko')

@section('content')
    <section class="py-12 bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h1 class="font-bold text-4xl text-gray-800 mb-4 tracking-tight">Koleksi Produk Terbaik</h1>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">Temukan produk berkualitas tinggi dengan harga terjangkau
                </p>
                <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto mt-4 rounded-full"></div>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach ($products as $index => $product)
                    <div class="product-card group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 fade-in"
                        style="animation-delay: {{ $index * 0.1 }}s;">
                        <!-- Product Image Container -->
                        <div class="relative overflow-hidden h-64 bg-gray-100">
                            <img src="{{ asset('storage/' . $product->path_img_222405) }}" alt="{{ $product->nama_222405 }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

                            <!-- Overlay with Quick View -->
                            <div
                                class="absolute inset-0  bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center">
                                <a href="{{ route('product.show', $product->id_produk_222405) }}"
                                    class="bg-white text-gray-800 px-4 py-2 rounded-full font-medium opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:bg-gray-100">
                                    <i class="fas fa-eye mr-2"></i>Lihat Detail
                                </a>
                            </div>
                        </div>

                        <!-- Product Info -->
                        <div class="p-6">
                            <h3
                                class="font-bold text-lg text-gray-800 mb-2 h-14 line-clamp-2 group-hover:text-blue-600 transition-colors duration-300">
                                {{ $product->nama_222405 }}
                            </h3>

                            <!-- Price -->
                            <div class="mb-4">
                                <span class="text-2xl font-bold text-blue-600">
                                    Rp {{ number_format($product->harga_222405, 0, ',', '.') }}
                                </span>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-2">
                                <!-- Add to Cart Button -->
                                <button onclick="addToCart('{{ $product->id_produk_222405 }}')"
                                    class="flex-1 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg flex items-center justify-center gap-2">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span>Keranjang</span>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Empty State -->
            @if ($products->isEmpty())
                <div class="text-center py-16">
                    <div class="w-32 h-32 bg-gray-200 rounded-full mx-auto mb-6 flex items-center justify-center">
                        <i class="fas fa-box-open text-4xl text-gray-400"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Produk</h3>
                    <p class="text-gray-500">Produk akan segera hadir. Silakan kembali lagi nanti.</p>
                </div>
            @endif
        </div>

        <!-- Scroll to Top Button -->
        <button id="scrollToTopButton"
            class="hidden fixed bottom-8 right-8 bg-gradient-to-r from-blue-500 to-purple-500 text-white p-4 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-110 z-50">
            <i class="fas fa-arrow-up"></i>
        </button>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <style>
            /* Enhanced Animations */
            .fade-in {
                opacity: 0;
                transform: translateY(30px);
                animation: fadeInUp 0.6s ease-out forwards;
            }

            @keyframes fadeInUp {
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            /* Product Card Hover Effects */
            .product-card:hover {
                transform: translateY(-8px);
                transition: all 0.3s ease;
            }

            /* Line Clamp Utility */
            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            html {
                scroll-behavior: smooth;
            }
        </style>
    </section>
@endsection


{{-- Push all scripts and external JS libraries to the 'scripts' stack --}}
@section('scripts')
    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Add to Cart Function
        function addToCart(productId) {
            // Periksa apakah pengguna sudah login
            if (!isUserLoggedIn()) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Login Diperlukan',
                    text: 'Silakan login terlebih dahulu untuk menambahkan produk ke keranjang.',
                    showCancelButton: true,
                    confirmButtonText: 'Login Sekarang',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#3B82F6'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('login') }}";
                    }
                });
                return;
            }

            // Tampilkan notifikasi loading
            Swal.fire({
                title: 'Menambahkan ke keranjang...',
                allowEscapeKey: false,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Kirim request ke server menggunakan Fetch API
            fetch(`{{ route('cart.add', ['productId' => ':id']) }}`.replace(':id', productId), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        quantity: 1
                    })
                })
                .then(response => {
                    // Sangat penting: Periksa jika ada redirect dari middleware 'auth'
                    if (response.redirected) {
                        window.location.href = response.url; // Arahkan ke halaman login
                        return Promise.reject(new Error('Redirecting to login.')); // Hentikan proses selanjutnya
                    }
                    return response.json(); // Lanjutkan untuk mem-parsing JSON
                })
                .then(data => {
                    // Periksa pesan dari backend
                    if (data && data.message === 'Product added to cart successfully') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Produk berhasil ditambahkan ke keranjang.',
                            timer: 2000,
                            showConfirmButton: false,
                            toast: true,
                            position: 'top-end'
                        });
                    } else {
                        // Jika ada pesan error dari backend
                        throw new Error(data.message || 'Gagal menambahkan produk.');
                    }
                })
                .catch(error => {
                    // Tangani semua jenis error (jaringan, redirect, atau dari backend)
                    // Jangan tampilkan error jika itu karena redirect
                    if (error.message !== 'Redirecting to login.') {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: error.message || 'Gagal menambahkan ke keranjang. Silakan coba lagi.',
                            confirmButtonColor: '#EF4444'
                        });
                    }
                });
        }

        // Check if user is logged in
        function isUserLoggedIn() {
            return {{ auth()->check() ? 'true' : 'false' }};
        }

        // Scroll to top functionality
        document.addEventListener("DOMContentLoaded", function() {
            const scrollToTopButton = document.getElementById("scrollToTopButton");

            window.addEventListener("scroll", () => {
                if (window.scrollY > 300) {
                    scrollToTopButton.classList.remove("hidden");
                } else {
                    scrollToTopButton.classList.add("hidden");
                }
            });

            scrollToTopButton.addEventListener("click", () => {
                window.scrollTo({
                    top: 0,
                    behavior: "smooth",
                });
            });
        });
    </script>
@endsection
