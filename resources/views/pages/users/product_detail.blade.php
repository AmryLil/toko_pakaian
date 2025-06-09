@extends('layouts.app')

@section('title', 'Product Detail')

@section('content')
    <div class="w-full mt-20 font-jost">
        <div class="bg-white p-4 rounded-lg shadow-xl gap-6">
            <div class="flex">
                <!-- Product Image -->
                <div class="w-1/2 flex justify-center relative h-[80vh] overflow-hidden border-2 shadow-md">
                    <img src="{{ Str::startsWith($product->path_img_222405, 'http') ? $product->path_img_222405 : asset('storage/' . $product->path_img_222405) }}"
                        alt="Product Image"
                        class="object-cover h-full w-full transform hover:scale-110 transition duration-300 ease-in-out">
                </div>

                <!-- Product Details -->
                <div class="w-1/2 flex flex-col p-4 justify-between px-8 space-y-6">
                    <div class="text-start">
                        <h1 class="text-5xl font-extrabold text-gray-800">{{ $product->nama_222405 }}</h1>
                        <p class="text-lg text-gray-500 font-medium mt-2">{{ $product->category->nama_222405 }}</p>
                        <div class="h-1 w-1/3 bg-gray-800 mt-4 rounded"></div>
                    </div>

                    <!-- Product Specs -->
                    <div class="space-y-6">
                        <div>
                            <p class="text-2xl font-semibold text-gray-700">Deskripsi</p>
                            <p class="text-lg text-gray-600 mt-2">{{ $product->deskripsi_222405 }}</p>
                        </div>

                        <!-- Quantity and Size Controls -->
                        <div class="flex gap-4 justify-between items-center">
                            <!-- Quantity Control -->
                            <div class="flex items-center border-gray-300 overflow-hidden w-max">
                                <button type="button" id="decrement"
                                    class="px-4 py-2 text-gray-700 text-lg font-bold bg-gray-200 hover:bg-gray-300 border-2 transition-colors duration-200 rounded-l-md">-</button>
                                <input id="qty" value="1" min="1" max="{{ $product->jumlah_222405 }}"
                                    class="w-16 text-center text-lg font-semibold border-t-2 border-b-2 border-gray-300 focus:ring-0 focus:outline-none py-2">
                                <button type="button" id="increment"
                                    class="px-4 py-2 border-2 text-gray-700 text-lg font-bold bg-gray-200 hover:bg-gray-300 transition-colors duration-200 rounded-r-md">+</button>
                            </div>

                            <!-- Size Selection -->
                            <div>
                                <p class="text-sm text-gray-600 mb-2">Pilih Ukuran:</p>
                                <div class="flex space-x-2">
                                    <button type="button"
                                        class="size-btn p-3 bg-black text-white border-2 border-gray-300 rounded-md active transition-all duration-200"
                                        data-size="S">S</button>
                                    <button type="button"
                                        class="size-btn p-3 bg-white text-gray-700 border-2 border-gray-300 rounded-md transition-all duration-200"
                                        data-size="M">M</button>
                                    <button type="button"
                                        class="size-btn p-3 bg-white text-gray-700 border-2 border-gray-300 rounded-md transition-all duration-200"
                                        data-size="L">L</button>
                                    <button type="button"
                                        class="size-btn p-3 bg-white text-gray-700 border-2 border-gray-300 rounded-md transition-all duration-200"
                                        data-size="XL">XL</button>
                                </div>
                            </div>
                        </div>

                        <!-- Stock Info -->
                        <div>
                            <p class="text-2xl font-semibold text-gray-700">Stok</p>
                            <div class="flex items-center mt-2">
                                <p class="text-lg font-bold text-gray-900">{{ $product->jumlah_222405 }} Barang</p>
                                @if ($product->jumlah_222405 <= 5)
                                    <span
                                        class="ml-2 px-2 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">Stok
                                        Terbatas</span>
                                @elseif($product->jumlah_222405 <= 10)
                                    <span
                                        class="ml-2 px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">Stok
                                        Menipis</span>
                                @else
                                    <span
                                        class="ml-2 px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Stok
                                        Tersedia</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Price -->
                    <div>
                        <p class="text-4xl font-extrabold text-gray-900">Rp
                            {{ number_format($product->harga_222405, 0, ',', '.') }}</p>
                        <div class="mt-4 flex justify-between items-center gap-4">
                            <!-- Checkout Button -->
                            <button id="checkout-btn" onclick="showPaymentModal()"
                                class="flex-1 py-3 px-6 bg-slate-950 text-white hover:bg-slate-800 transform transition hover:scale-105 shadow-lg border-2 border-slate-950 rounded-md font-semibold">
                                Checkout Sekarang →
                            </button>

                            <!-- Add to Cart Button -->
                            <button id="add-to-cart"
                                class="flex items-center justify-center bg-white text-slate-950 border-2 hover:bg-gray-50 border-slate-950 transform transition hover:scale-105 shadow-lg px-4 py-3 rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                    class="w-6 h-6">
                                    <path
                                        d="M15.7688625 3.28358125c-0.057225 -0.06870625 -0.14199375 -0.1084625 -0.23140625 -0.10854375H3.12604375L2.6225375 0.40723125c-0.02618125 -0.143075 -0.15078125 -0.2470625 -0.29623125 -0.24723125H0.46225625c-0.23209375 0 -0.37715625 0.25125625 -0.26110625 0.45225625 0.05385625 0.0932875 0.15339375 0.15075 0.26110625 0.15075h1.61229375l0.50426875 2.7738375 1.46304375 8.04865c0.06745 0.367825 0.26920625 0.69745625 0.566075 0.9248625 -1.170525 0.75443125 -1.0854 2.4930875 0.15321875 3.12956875 1.23861875 0.6364875 2.701775 -0.30655625 2.63368125 -1.697475 -0.0203125 -0.41484375 -0.18275 -0.8100625 -0.46004375 -1.11928125h4.54215625c-0.9283875 1.03796875 -0.38499375 2.69171875 0.9781125 2.9767375 1.36310625 0.285025 2.52359375 -1.01244375 2.08888125 -2.3354375 -0.244125 -0.74294375 -0.938 -1.24491875 -1.720025 -1.2443125H5.5252625c-0.436875 -0.0002125 -0.8111625 -0.31264375 -0.8894375 -0.74245l-0.3015 -1.66958125h9.10014375c0.72858125 0.0001125 1.35298125 -0.52085625 1.48339375 -1.237675L15.8344375 3.5308125c0.0159125 -0.08805625 -0.0081125 -0.1786375 -0.065575 -0.24723125ZM6.79384375 14.02918125c0 0.92839375 -1.0050125 1.5086375 -1.809025 1.0444375 -0.8040125 -0.46419375 -0.8040125 -1.62468125 0 -2.088875 0.18331875 -0.10584375 0.391325 -0.16156875 0.60300625 -0.16158125 0.6660875 -0.000025 1.20601875 0.53993125 1.20601875 1.20601875Zm7.23609375 0c0 0.92839375 -1.0050125 1.5086375 -1.809025 1.0444375 -0.8040125 -0.46419375 -0.8040125 -1.62468125 0 -2.088875 0.18335625 -0.1058625 0.3912875 -0.1615875 0.60300625 -0.16158125 0.66604375 0.00003125 1.20601875 0.539975 1.20601875 1.20601875Zm0.29471875 -5.56651875c-0.078325 0.4300875 -0.45303125 0.74260625 -0.8901875 0.74245625H4.2220125L3.23534375 3.77805h11.9410625Z"
                                        stroke-width="0.0625"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Cart Success Modal -->
                        <dialog id="cart_modal" class="modal">
                            <div class="modal-box max-w-sm">
                                <div
                                    class="flex items-center justify-center w-12 h-12 mx-auto bg-green-100 rounded-full mb-4">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-center mb-2">Berhasil!</h3>
                                <p class="text-center text-gray-600 mb-4">Produk berhasil ditambahkan ke keranjang</p>
                                <div class="flex justify-center">
                                    <form method="dialog">
                                        <button class="btn btn-sm btn-primary">OK</button>
                                    </form>
                                </div>
                            </div>
                        </dialog>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Modal -->
        <div id="payment-modal" class="fixed z-50 inset-0 hidden flex items-center justify-center overflow-auto"
            style="background-color: rgba(0,0,0,0.7);">
            <div
                class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 p-6 relative border-l-4 border-green-500 max-h-[90vh] overflow-y-auto">
                <button onclick="closePaymentModal()"
                    class="absolute top-4 right-4 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-full w-8 h-8 flex items-center justify-center font-bold transition-all duration-200 z-10">&times;</button>

                <div class="flex items-center mb-6">
                    <div class="bg-green-500 rounded-full p-2 mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">Pembayaran QRIS</h2>
                </div>

                <!-- Order Summary -->
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-200 mb-6">
                    <h3 class="font-semibold text-gray-700 mb-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Ringkasan Pesanan
                    </h3>
                    <div class="space-y-2">
                        <div class="flex justify-between items-center text-sm">
                            <div class="flex items-center">
                                <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                <span class="text-gray-700 truncate">{{ $product->nama_222405 }}</span>
                            </div>
                            <span class="text-gray-800 font-medium">Rp
                                {{ number_format($product->harga_222405, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-600">Ukuran:</span>
                            <span class="text-gray-800 font-medium" id="modal-size">S</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-600">Jumlah:</span>
                            <span class="text-gray-800 font-medium" id="modal-qty">1</span>
                        </div>
                        <div class="border-t border-gray-300 pt-2 mt-3">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-800 font-bold">Total Pembayaran:</span>
                                <span class="text-green-600 font-bold text-lg" id="modal-total">
                                    Rp {{ number_format($product->harga_222405, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- QR Code Section -->
                <div id="qr-section" class="transition-all duration-300">
                    <div class="text-center mb-4">
                        <h3 class="font-semibold text-gray-700 mb-2">Scan QR Code untuk Pembayaran</h3>
                        <p class="text-gray-600 text-sm">Gunakan aplikasi e-wallet untuk scan QR code di bawah ini</p>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 mb-6">
                        <div class="flex justify-center">
                            <div class="bg-white p-3 rounded-xl shadow-md">
                                <img src="{{ asset('images/frame.png') }}" alt="QRIS Code"
                                    class="w-48 h-48 object-contain">
                            </div>
                        </div>
                        <div class="text-center text-xs text-gray-500 mt-3 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Pastikan jumlah pembayaran sesuai dengan total di atas
                        </div>
                    </div>

                    <div class="flex justify-center">
                        <button onclick="toggleUploadSection()"
                            class="bg-green-500 text-white font-medium py-3 px-6 rounded-xl hover:bg-green-600 transition-colors duration-200 shadow-md flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            Sudah Bayar? Upload Bukti
                        </button>
                    </div>
                </div>

                <!-- Upload Section -->
                <div id="upload-section" class="hidden transition-all duration-300">
                    <div class="text-center mb-4">
                        <h3 class="font-semibold text-gray-700 mb-2">Upload Bukti Pembayaran</h3>
                        <p class="text-gray-600 text-sm">Upload screenshot atau foto bukti transfer Anda</p>
                    </div>

                    <form id="upload-receipt-form" enctype="multipart/form-data" class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-3 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-green-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            Pilih File Bukti Pembayaran:
                        </label>
                        <div
                            class="border-2 border-gray-200 border-dashed rounded-xl p-6 text-center hover:bg-gray-50 transition-colors duration-200 file-upload-area">
                            <input type="file" name="receipt" id="receipt" class="hidden"
                                accept="image/jpeg,image/png,image/jpg" required onchange="previewReceipt()">
                            <label for="receipt" class="cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 mb-3"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <span class="text-gray-600 font-medium">Klik untuk memilih file</span>
                                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG (Maksimal 2MB)</p>
                            </label>
                        </div>
                    </form>

                    <div id="receipt-preview" class="hidden mb-4">
                        <h4 class="font-semibold text-gray-700 mb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-green-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Preview Bukti Pembayaran:
                        </h4>
                        <div class="border border-gray-200 rounded-xl overflow-hidden">
                            <img id="receipt-image" src="" alt="Bukti Pembayaran"
                                class="w-full h-auto max-h-64 object-contain">
                        </div>
                    </div>

                    <div class="flex justify-center mb-4">
                        <button onclick="toggleUploadSection()"
                            class="bg-gray-100 text-gray-700 font-medium py-2 px-4 rounded-xl hover:bg-gray-200 transition-colors duration-200 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                            Kembali ke QR Code
                        </button>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                    <button onclick="closePaymentModal()"
                        class="bg-gray-100 text-gray-700 font-medium py-2 px-4 rounded-xl hover:bg-gray-200 transition-colors duration-200">
                        Batal
                    </button>
                    <button id="submit-button" onclick="submitPaymentProof()"
                        class="bg-green-500 text-white font-medium py-2 px-6 rounded-xl hover:bg-green-600 transition-colors duration-200 shadow-md flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Konfirmasi Pembayaran
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Notification Container -->
    <div id="notification-container" class="fixed top-4 right-4 z-50 space-y-2"></div>
    <meta name = "csrf-token" content = "{{ csrf_token() }}">

    <script>
        // Pass data dari Laravel ke JavaScript dengan proper escaping
        let selectedSize = 'S'; // Default size
        let currentQty = 1;
        let productPrice = {!! json_encode($product->harga_222405 ?? 0) !!};
        let productId = {!! json_encode($product->id_produk_222405 ?? null) !!};
        let productStock = {!! json_encode($product->jumlah_222405 ?? 0) !!};

        // Validasi data sebelum digunakan
        if (!productId) {
            console.error('Product ID tidak tersedia');
            showNotification('Terjadi kesalahan: ID produk tidak valid', 'error');
        }

        // DOM Content Loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Pastikan semua data tersedia sebelum inisialisasi
            if (productId && productPrice !== null && productStock !== null) {
                initializeQuantityControls();
                initializeSizeSelection();
                initializeCheckoutHandlers();
                updateModalTotal();
            } else {
                console.error('Data produk tidak lengkap:', {
                    productId,
                    productPrice,
                    productStock
                });
                showNotification('Data produk tidak lengkap', 'error');
            }
        });

        // Initialize quantity controls
        function initializeQuantityControls() {
            const qtyInput = document.getElementById('qty');
            const incrementBtn = document.getElementById('increment');
            const decrementBtn = document.getElementById('decrement');

            // Validasi elemen DOM
            if (!qtyInput || !incrementBtn || !decrementBtn) {
                console.error('Elemen quantity control tidak ditemukan');
                return;
            }

            // Increment quantity
            incrementBtn.addEventListener('click', function() {
                const newQty = parseInt(qtyInput.value) + 1;
                if (newQty <= productStock) {
                    currentQty = newQty;
                    qtyInput.value = currentQty;
                    updateModalTotal();
                } else {
                    showNotification(`Stok hanya tersedia ${productStock} item`, 'warning');
                }
            });

            // Decrement quantity
            decrementBtn.addEventListener('click', function() {
                if (parseInt(qtyInput.value) > 1) {
                    currentQty = parseInt(qtyInput.value) - 1;
                    qtyInput.value = currentQty;
                    updateModalTotal();
                }
            });

            // Handle direct input
            qtyInput.addEventListener('input', function() {
                let value = parseInt(this.value);
                if (value < 1 || isNaN(value)) {
                    value = 1;
                    this.value = 1;
                } else if (value > productStock) {
                    value = productStock;
                    this.value = productStock;
                    showNotification(`Stok hanya tersedia ${productStock} item`, 'warning');
                }
                currentQty = value;
                updateModalTotal();
            });
        }

        // Initialize size selection
        function initializeSizeSelection() {
            const sizeButtons = document.querySelectorAll('.size-btn');

            if (sizeButtons.length === 0) {
                console.warn('Tombol size tidak ditemukan');
                return;
            }

            sizeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons
                    sizeButtons.forEach(btn => {
                        btn.classList.remove('bg-black', 'text-white');
                        btn.classList.add('bg-white', 'text-gray-700');
                    });

                    // Add active class to clicked button
                    this.classList.remove('bg-white', 'text-gray-700');
                    this.classList.add('bg-black', 'text-white');

                    // Update selected size
                    selectedSize = this.getAttribute('data-size');
                });
            });
        }

        // Initialize checkout handlers
        function initializeCheckoutHandlers() {
            const checkoutBtn = document.getElementById('co');
            const addToCartBtn = document.getElementById('add-to-cart');

            // Add to cart handler
            if (addToCartBtn) {
                addToCartBtn.addEventListener('click', function() {
                    addToCart();
                });
            }

            // Checkout handler jika ada
            if (checkoutBtn) {
                checkoutBtn.addEventListener('click', function() {
                    showPaymentModal();
                });
            }
        }

        // Submit payment proof dengan validasi productId
        function submitPaymentProof() {
            // Debug log untuk melihat data yang akan dikirim
            console.log('=== SUBMIT PAYMENT DEBUG ===');
            console.log('Product ID:', productId);
            console.log('Current Qty:', currentQty);
            console.log('Selected Size:', selectedSize);

            // Validasi productId terlebih dahulu
            if (!productId) {
                showNotification('ID produk tidak valid', 'error');
                console.error('ProductId is null or undefined:', productId);
                return;
            }

            const receiptInput = document.getElementById('receipt');

            if (!receiptInput || !receiptInput.files || !receiptInput.files[0]) {
                showNotification('Harap pilih bukti pembayaran terlebih dahulu', 'error');
                return;
            }

            // Validate file type
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            if (!allowedTypes.includes(receiptInput.files[0].type)) {
                showNotification('Format file tidak didukung. Gunakan JPG, PNG, atau GIF', 'error');
                return;
            }

            // Validate file size (max 2MB)
            if (receiptInput.files[0].size > 2 * 1024 * 1024) {
                showNotification('Ukuran file terlalu besar. Maksimal 2MB', 'error');
                return;
            }

            // Debug file info
            console.log('File info:', {
                name: receiptInput.files[0].name,
                size: receiptInput.files[0].size,
                type: receiptInput.files[0].type
            });

            // Create FormData
            const formData = new FormData();
            formData.append('receipt', receiptInput.files[0]);
            formData.append('quantity', currentQty);
            formData.append('size', selectedSize);
            formData.append('product_id', productId); // Tambahkan product_id eksplisit

            // Pastikan token CSRF tersedia
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (csrfToken) {
                formData.append('_token', csrfToken.getAttribute('content'));
                console.log('CSRF Token found:', csrfToken.getAttribute('content').substring(0, 10) + '...');
            } else {
                console.error('CSRF Token not found!');
                showNotification('Token keamanan tidak ditemukan', 'error');
                return;
            }

            // Debug FormData contents
            console.log('FormData contents:');
            for (let pair of formData.entries()) {
                console.log(pair[0] + ': ' + (pair[1] instanceof File ? `File: ${pair[1].name}` : pair[1]));
            }

            // Show loading state
            const submitBtn = document.getElementById('submit-button');
            if (!submitBtn) {
                showNotification('Tombol submit tidak ditemukan', 'error');
                return;
            }

            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <svg class="animate-spin h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Memproses...
            `;

            // Construct URL dan log untuk debugging
            const submitUrl = `/checkout/${productId}`;
            console.log('Submit URL:', submitUrl);

            // Submit to server dengan URL yang benar
            fetch(submitUrl, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    console.log('Response status:', response.status);
                    console.log('Response headers:', response.headers);

                    // Coba baca response sebagai text dulu untuk debugging
                    return response.text().then(text => {
                        console.log('Raw response:', text);

                        if (!response.ok) {
                            // Jika status bukan 2xx, lempar error dengan detail response
                            throw new Error(`HTTP ${response.status}: ${text}`);
                        }

                        // Coba parse sebagai JSON
                        try {
                            return JSON.parse(text);
                        } catch (e) {
                            console.error('Response bukan JSON valid:', text);
                            throw new Error('Response tidak valid dari server');
                        }
                    });
                })
                .then(data => {
                    console.log('Parsed response data:', data);

                    if (data.success || data.message === 'Checkout berhasil') {
                        showNotification('Checkout berhasil! Transaksi Anda sedang diproses.', 'success');
                        closePaymentModal();

                        // Optional: Redirect after success
                        setTimeout(() => {
                            window.location.href = '/pesanan';
                        }, 2000);
                    } else {
                        showNotification(data.message || 'Terjadi kesalahan', 'error');
                    }
                })
                .catch(error => {
                    console.error('=== FETCH ERROR ===');
                    console.error('Error object:', error);
                    console.error('Error message:', error.message);
                    console.error('Error stack:', error.stack);

                    // Tampilkan error yang lebih informatif
                    let errorMessage = 'Terjadi kesalahan saat memproses pembayaran';

                    if (error.message.includes('HTTP 500')) {
                        errorMessage = 'Kesalahan server (500). Periksa log server untuk detail.';
                    } else if (error.message.includes('HTTP 422')) {
                        errorMessage = 'Data tidak valid. Periksa form input.';
                    } else if (error.message.includes('HTTP 404')) {
                        errorMessage = 'URL tidak ditemukan. Periksa route checkout.';
                    } else if (error.message.includes('NetworkError') || error.message.includes('Failed to fetch')) {
                        errorMessage = 'Koneksi bermasalah. Periksa koneksi internet.';
                    }

                    showNotification(errorMessage, 'error');
                })
                .finally(() => {
                    // Reset button state
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                    console.log('=== SUBMIT PAYMENT COMPLETED ===');
                });
        }

        // Show payment modal
        function showPaymentModal() {
            if (!productId) {
                showNotification('ID produk tidak valid', 'error');
                return;
            }

            // Update quantity from input
            const qtyInput = document.getElementById('qty');
            if (qtyInput) {
                currentQty = parseInt(qtyInput.value);
            }

            // Update modal content
            updateModalTotal();

            // Show modal
            const modal = document.getElementById('payment-modal');
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }

        // Close payment modal
        function closePaymentModal() {
            const modal = document.getElementById('payment-modal');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                resetModalState();
            }
        }

        // Update modal total price
        function updateModalTotal() {
            const totalPrice = productPrice * currentQty;

            // Update modal summary
            const modalSize = document.getElementById('modal-size');
            const modalQty = document.getElementById('modal-qty');
            const modalTotal = document.getElementById('modal-total');

            if (modalSize) modalSize.textContent = selectedSize;
            if (modalQty) modalQty.textContent = currentQty;
            if (modalTotal) modalTotal.textContent = `Rp ${formatNumber(totalPrice)}`;
        }

        // Update modal summary dengan template literal yang aman
        function updateModalSummary() {
            const summarySection = document.querySelector('#payment-modal .bg-gray-50');
            if (summarySection) {
                const totalPrice = productPrice * currentQty;
                const productName = {!! json_encode($product->nama_222405 ?? 'Produk') !!};

                summarySection.innerHTML = `
                    <div class="flex justify-between items-center text-sm mb-2">
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                            <span class="text-gray-700 truncate">${productName}</span>
                        </div>
                        <span class="text-green-600 font-bold">Rp ${formatNumber(productPrice)}</span>
                    </div>
                    <div class="flex justify-between items-center text-sm mb-2">
                        <span class="text-gray-600">Ukuran:</span>
                        <span class="text-gray-800 font-medium">${selectedSize}</span>
                    </div>
                    <div class="flex justify-between items-center text-sm mb-2">
                        <span class="text-gray-600">Jumlah:</span>
                        <span class="text-gray-800 font-medium">${currentQty}</span>
                    </div>
                    <div class="border-t pt-2 mt-2">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-800 font-semibold">Total:</span>
                            <span class="text-green-600 font-bold text-lg">Rp ${formatNumber(totalPrice)}</span>
                        </div>
                    </div>
                `;
            }
        }

        // Toggle upload section
        function toggleUploadSection() {
            const qrSection = document.getElementById('qr-section');
            const uploadSection = document.getElementById('upload-section');

            if (!qrSection || !uploadSection) {
                console.error('Section QR atau Upload tidak ditemukan');
                return;
            }

            if (qrSection.classList.contains('hidden')) {
                qrSection.classList.remove('hidden');
                uploadSection.classList.add('hidden');
            } else {
                qrSection.classList.add('hidden');
                uploadSection.classList.remove('hidden');
            }
        }

        // Preview receipt
        function previewReceipt() {
            const fileInput = document.getElementById('receipt');
            const preview = document.getElementById('receipt-preview');
            const previewImage = document.getElementById('receipt-image');

            if (!fileInput || !preview || !previewImage) {
                console.error('Elemen preview tidak ditemukan');
                return;
            }

            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    preview.classList.remove('hidden');
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        }

        // Add to cart function
        function addToCart() {
            const qtyInput = document.getElementById('qty');
            if (qtyInput) {
                currentQty = parseInt(qtyInput.value);
            }

            showNotification(`${currentQty} item ditambahkan ke keranjang (Ukuran: ${selectedSize})`, 'success');

            const modal = document.getElementById('my_modal_3');
            if (modal && typeof modal.showModal === 'function') {
                modal.showModal();
            }
        }

        // Reset modal state
        function resetModalState() {
            const qrSection = document.getElementById('qr-section');
            const uploadSection = document.getElementById('upload-section');
            const receiptPreview = document.getElementById('receipt-preview');
            const receiptInput = document.getElementById('receipt');

            if (qrSection) qrSection.classList.remove('hidden');
            if (uploadSection) uploadSection.classList.add('hidden');
            if (receiptPreview) receiptPreview.classList.add('hidden');
            if (receiptInput) receiptInput.value = '';
        }

        // Show notification
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className =
                `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg text-white font-medium transition-all duration-300 transform translate-x-full`;

            switch (type) {
                case 'success':
                    notification.classList.add('bg-green-500');
                    break;
                case 'error':
                    notification.classList.add('bg-red-500');
                    break;
                case 'warning':
                    notification.classList.add('bg-yellow-500');
                    break;
                default:
                    notification.classList.add('bg-blue-500');
            }

            notification.textContent = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);

            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    if (document.body.contains(notification)) {
                        document.body.removeChild(notification);
                    }
                }, 300);
            }, 3000);
        }

        // Format number with thousands separator
        function formatNumber(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // Close modal when clicking outside
        document.addEventListener('click', function(event) {
            const modal = document.getElementById('payment-modal');
            if (modal && event.target === modal) {
                closePaymentModal();
            }
        });

        // Handle escape key to close modal
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closePaymentModal();
            }
        });

        // Debug function untuk cek data
        function debugProductData() {
            console.log('=== PRODUCT DATA DEBUG ===');
            console.log('Product ID:', productId, typeof productId);
            console.log('Product Price:', productPrice, typeof productPrice);
            console.log('Product Stock:', productStock, typeof productStock);
            console.log('Selected Size:', selectedSize);
            console.log('Current Qty:', currentQty);
            console.log('CSRF Token:', document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'));
            console.log('Current URL:', window.location.href);
            console.log('Checkout URL will be:', `/checkout/${productId}`);
            console.log('==========================');
        }

        // Fungsi untuk test koneksi ke server
        function testServerConnection() {
            console.log('Testing server connection...');
            fetch('/test-connection', {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    console.log('Test connection response:', response.status);
                    return response.text();
                })
                .then(data => {
                    console.log('Test connection data:', data);
                })
                .catch(error => {
                    console.error('Test connection error:', error);
                });
        }

        // Panggil debug saat development (hapus di production)
        // debugProductData();

        // Tambahkan ke window untuk debugging manual
        window.debugProductData = debugProductData;
        window.testServerConnection = testServerConnection;
    </script>
@endsection

@push('styles')
    <style>
        /* Additional styles for better UX */
        .size-btn {
            transition: all 0.2s ease-in-out;
            min-width: 40px;
            min-height: 40px;
        }

        .size-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .size-btn.active {
            background-color: #1f2937 !important;
            color: white !important;
            border-color: #1f2937 !important;
        }

        /* Quantity input styling */
        #qty {
            border-left: 0;
            border-right: 0;
        }

        /* Modal animation */
        #payment-modal {
            backdrop-filter: blur(4px);
        }

        #payment-modal .bg-white {
            animation: modalSlideIn 0.3s ease-out;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-20px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* File upload area styling */
        .file-upload-area {
            transition: all 0.2s ease-in-out;
        }

        .file-upload-area:hover {
            border-color: #10b981;
            background-color: #f0fdf4;
        }

        /* Loading spinner */
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .spinner {
            animation: spin 1s linear infinite;
        }

        /* Notification styles */
        .notification {
            transform: translateX(100%);
            transition: transform 0.3s ease-out;
        }

        .notification.show {
            transform: translateX(0);
        }

        /* Button hover effects */
        .btn-hover-scale {
            transition: transform 0.2s ease-in-out;
        }

        .btn-hover-scale:hover {
            transform: scale(1.02);
        }

        /* Responsive adjustments */
        @media (max-width: 1024px) {
            .flex {
                flex-direction: column;
            }

            .w-1\/2 {
                width: 100%;
            }

            .h-\[80vh\] {
                height: 50vh;
            }
        }

        @media (max-width: 768px) {
            #payment-modal .bg-white {
                width: 95%;
                margin: 10px;
                max-height: 95vh;
            }

            .size-btn {
                padding: 8px 12px;
                font-size: 14px;
                min-width: 35px;
                min-height: 35px;
            }

            .text-5xl {
                font-size: 2.5rem;
            }

            .text-4xl {
                font-size: 2rem;
            }
        }

        @media (max-width: 640px) {
            .px-8 {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .space-y-6>*+* {
                margin-top: 1.5rem;
            }

            .flex.gap-4 {
                flex-direction: column;
                gap: 1rem;
            }

            .justify-between {
                justify-content: flex-start;
            }
        }
    </style>
@endpush
