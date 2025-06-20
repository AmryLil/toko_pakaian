@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <section class="">
        <div class=" h-[500px] w-full overflow-hidden bg-linen flex items-center font-jost   ">
            <div class="flex gap-2 items-center justify-between w-full h-full ">
                <div class="translate-x-20">
                    <h1 class="text-6xl font-semibold">KOLEKSI MUSIM PANAS 2025</h1>
                    <P class="mt-2">Temukan gaya terbaru dengan koleksi eksklusif kami. Nikmati kenyamanan dan kemewahan
                        dalam setiap pilihan pakaian yang telah dirancang khusus untuk Anda yang menghargai kualitas dan
                        style.</P>
                    <button class="border mt-10 border-slate-950 px-4 py-1">BELANJA SEKARANG</button>
                </div>
                <img src="{{ asset('images/banner.png') }}" alt=""
                    class="w-[130%] h-full object-cover object-[30%_0%]  ">
            </div>
        </div>
        <div class=" flex gap-4 py-4">
            <div class="w-1/2 h-40 bg-linen flex items-center justify-center">
                <div class="text-center">
                    <h3 class="text-2xl font-semibold mb-2">GRATIS ONGKIR</h3>
                    <p class="text-gray-600">Untuk pembelian minimal Rp 500.000</p>
                </div>
            </div>
            <div class="w-1/2 h-40 bg-linen flex items-center justify-center">
                <div class="text-center">
                    <h3 class="text-2xl font-semibold mb-2">GARANSI KUALITAS</h3>
                    <p class="text-gray-600">Jaminan uang kembali 100%</p>
                </div>
            </div>
        </div>
    </section>

    <section class=" py-10">
        <h1 class="font-semibold text-xl text-center mb-5">KOLEKSI TERBARU</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach ($products as $index => $product)
                <div
                    class="product-card group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 fade-in">
                    <!-- Product Image Container -->
                    <div class="relative overflow-hidden h-64 bg-gray-100">
                        <img src="{{ asset('storage/' . $product->path_img_222405) }}" alt="{{ $product->nama_222405 }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

                        <!-- Overlay with Quick View -->
                        <div
                            class="absolute inset-0 bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center">
                            <a href="{{ route('product.show', $product->id_produk_222405) }}"
                                class="bg-white text-gray-800 px-4 py-2 rounded-full font-medium opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:bg-gray-100">
                                <i class="fas fa-eye mr-2"></i>Lihat Detail
                            </a>
                        </div>


                    </div>

                    <!-- Product Info -->
                    <div class="p-6">
                        <h3
                            class="font-bold text-lg text-gray-800 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors duration-300">
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
                            <button onclick="addToCart({{ $product->id_produk_222405 }})"
                                class="flex-1 bg-linen text-black font-semibold py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg flex items-center justify-center gap-2">
                                <i class="fas fa-shopping-cart"></i>
                                <span>Keranjang</span>
                            </button>


                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section>
        <!-- Product Section -->
        <div class=" mx-auto py-10 ">
            <div class="relative w-full bg-linen h-96  flex items-center justify-between">
                <img src="{{ asset('images/banner.png') }}" alt=""
                    class="w-[70%] h-full object-cover object-[30%_0%]  -translate-x-10">
                <div class="pr-10">
                    <h1 class="text-3xl font-bold">KOLEKSI OLAHRAGA</h1>
                    <p class="text-gray-700 mt-2">Koleksi terbaru sudah tersedia secara online dan di toko. Hadir dalam
                        berbagai pilihan warna, bahan, dan gaya yang sesuai dengan aktivitas olahraga Anda.</p>
                    <a href="#" class="mt-4 inline-block bg-black text-white px-4 py-2">BELANJA SEKARANG →</a>
                </div>
            </div>
        </div>
    </section>

    {{-- <section>
        <div class=" mx-auto py-10 ">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold">KATEGORI PRODUK</h2>
                <a href="#" class="text-gray-500 hover:underline">LIHAT SEMUA →</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Category 1 -->
                <div class="relative group bg-linen">
                    <img src="{{ asset('images/banner.png') }}" alt="Kemeja" class="w-full h-auto object-cover">
                    <div class="absolute mx-6 bottom-4 left-0 right-0 bg-white text-center py-2">
                        <span class="font-semibold text-gray-800">KEMEJA & BLOUSE</span>
                    </div>
                </div>

                <!-- Category 2 -->
                <div class="relative group bg-linen">
                    <img src="{{ asset('images/banner.png') }}" alt="Celana" class="w-full h-auto object-cover">
                    <div class="absolute mx-6 bottom-4 left-0 right-0 bg-white text-center py-2">
                        <span class="font-semibold text-gray-800">CELANA & ROK</span>
                    </div>
                </div>

                <!-- Category 3 -->
                <div class="relative group bg-linen">
                    <img src="{{ asset('images/banner.png') }}" alt="Dress" class="w-full h-auto object-cover">
                    <div class="absolute mx-6 bottom-4 left-0 right-0 bg-white text-center py-2">
                        <span class="font-semibold text-gray-800">DRESS & TERUSAN</span>
                    </div>
                </div>

                <!-- Category 4 -->
                <div class="relative group bg-linen">
                    <img src="{{ asset('images/banner.png') }}" alt="Outerwear" class="w-full h-auto object-cover">
                    <div class="absolute mx-6 bottom-4 left-0 right-0 bg-white text-center py-2">
                        <span class="font-semibold text-gray-800">JAKET & OUTER</span>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

@endsection

@section('scripts')
    <style>
        /* Animasi Fade-in untuk Kartu Produk */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.5s ease-out forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Animasi Modal */
        .modal[open] {
            opacity: 1 !important;
            transform: scale(1) !important;
        }
    </style>
    <script>
        function toggleModal(modalId, show = true) {
            const modal = document.getElementById(modalId);
            modal.classList.toggle('hidden', !show);
        }

        function isUserLoggedIn() {
            return {{ auth()->check() ? 'true' : 'false' }};
        }

        document.querySelectorAll('#add-to-cart').forEach(button => {
            button.addEventListener('click', async function() {
                if (!isUserLoggedIn()) {
                    window.location.href = "{{ route('login') }}";
                    return;
                }

                const productId = this.dataset.productId; // Ambil ID produk dari data-attribute tombol
                const qty = 1; // Set default quantity

                if (isNaN(qty) || qty < 1) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Jumlah harus minimal 1.'
                    });
                    return;
                }

                try {
                    const response = await fetch(`#`.replace(':id',
                        productId), {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            quantity: qty
                        })
                    });

                    if (!response.ok) {
                        throw new Error('Terjadi kesalahan saat menambahkan ke keranjang.');
                    }

                    const data = await response.json();
                    console.log('Response:', data);

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Produk berhasil ditambahkan ke keranjang.',
                        timer: 2000,
                        showConfirmButton: false
                    });

                } catch (error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Gagal menambahkan ke keranjang. Silakan coba lagi.'
                    });
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const swiper = new Swiper('.swiper-container', {
                slidesPerView: 1, // Menampilkan satu slide per kali
                loop: true, // Slider akan kembali ke awal setelah slide terakhir
                autoplay: {
                    delay: 3000, // Interval antar slide (ms)
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination', // Elemen pagination
                    clickable: true, // Membuat pagination interaktif
                },
                speed: 600, // Kecepatan transisi slide (ms)
                effect: 'fade', // Tambahkan efek transisi jika ingin
                fadeEffect: {
                    crossFade: true, // Memperhalus efek transisi fade
                },
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const scrollToTopButton = document.getElementById("scrollToTopButton");

            window.addEventListener("scroll", () => {
                if (window.scrollY > 00) {
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

    <!-- JavaScript untuk Animasi Modal -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('my_modal_3');
            if (modal) {
                modal.addEventListener('click', (event) => {
                    if (event.target === modal) {
                        modal.close();
                    }
                });
            }
        });

        // Tambahkan delay ke setiap kartu produk untuk animasi berurutan
        document.querySelectorAll('.fade-in').forEach((el, index) => {
            el.style.animationDelay = `${index * 0.2}s`;
        });
    </script>
@endsection
