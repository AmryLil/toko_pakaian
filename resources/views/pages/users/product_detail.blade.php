@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="w-full mt-20 font-jost">
        <div class="bg-white p-4 rounded-lg shadow-xl gap-6 ">
            <div class="flex">
                <!-- Product Image -->
                <div class="w-1/2 flex justify-center relative h-[80vh] overflow-hidden border-2 shadow-md ">
                    <img src="{{ Str::startsWith($product->path_img_222405, 'http') ? $product->path_img_222405 : asset('storage/' . $product->path_img_222405) }}"
                        alt="Product Image"
                        class="object-cover h-full transform hover:scale-110 transition duration-300 ease-in-out">
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
                        <div class="flex gap-4 justify-between">
                            <div class="flex items-center  border-gray-300 overflow-hidden w-max">
                                <button type="button" id="decrement"
                                    class="px-4 py-2 text-gray-700 text-lg font-bold bg-gray-200 hover:bg-gray-300 border-2 ">-</button>
                                <input id="qty" value="1" min="1"
                                    class="w-12 text-center text-lg font-semibold border-0 focus:ring-0 focus:outline-none ">
                                <button type="button" id="increment"
                                    class="px-3 py-2 border-2 text-gray-700 text-lg font-bold bg-gray-200 hover:bg-gray-300 border">+</button>
                            </div>

                            <div>
                                <div class="flex space-x-2">
                                    <button type="button" class="size-btn p-3 bg-black text-white border"
                                        data-size="S">S</button>
                                    <button type="button" class="size-btn p-3 bg-white text-gray-700 border"
                                        data-size="M">M</button>
                                    <button type="button" class="size-btn p-3 bg-white text-gray-700 border"
                                        data-size="L">L</button>
                                    <button type="button" class="size-btn p-3 bg-white text-gray-700 border"
                                        data-size="L">XL</button>
                                </div>
                            </div>
                        </div>

                        <div>
                            <p class="text-2xl font-semibold text-gray-700">Stok</p>
                            <p class="text-lg font-bold text-gray-900">{{ $product->jumlah_222405 }} Barang</p>
                        </div>
                    </div>

                    <!-- Price -->
                    <div>
                        <p class="text-4xl font-extrabold text-gray-900">Rp
                            {{ number_format($product->harga_222405, 0, ',', '.') }}</p>
                        <div class="mt-4 flex justify-between items-center gap-4">
                            <!-- Checkout Button -->
                            <button id="co" onclick="showPaymentModal()"
                                class="  py-3 px-6  hover:bg-linen transform transition hover:scale-105 shadow-lg w-full text-slate-950 border-2 border-slate-950">
                                Checkout Sekarang →
                            </button>

                            <!-- Add to Cart Button -->
                            <button id="add-to-cart"
                                class="flex items-center justify-center  text-white border-2 hover:bg-linen  border-slate-950 transform transition hover:scale-105 shadow-lg px-4 py-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="#000000"
                                    id="Shopping-Cart-Thin--Streamline-Phosphor-Thin" height="31" width="31">
                                    <desc>Shopping Cart Thin Streamline Icon: https://streamlinehq.com</desc>
                                    <path
                                        d="M15.7688625 3.28358125c-0.057225 -0.06870625 -0.14199375 -0.1084625 -0.23140625 -0.10854375H3.12604375L2.6225375 0.40723125c-0.02618125 -0.143075 -0.15078125 -0.2470625 -0.29623125 -0.24723125H0.46225625c-0.23209375 0 -0.37715625 0.25125625 -0.26110625 0.45225625 0.05385625 0.0932875 0.15339375 0.15075 0.26110625 0.15075h1.61229375l0.50426875 2.7738375 1.46304375 8.04865c0.06745 0.367825 0.26920625 0.69745625 0.566075 0.9248625 -1.170525 0.75443125 -1.0854 2.4930875 0.15321875 3.12956875 1.23861875 0.6364875 2.701775 -0.30655625 2.63368125 -1.697475 -0.0203125 -0.41484375 -0.18275 -0.8100625 -0.46004375 -1.11928125h4.54215625c-0.9283875 1.03796875 -0.38499375 2.69171875 0.9781125 2.9767375 1.36310625 0.285025 2.52359375 -1.01244375 2.08888125 -2.3354375 -0.244125 -0.74294375 -0.938 -1.24491875 -1.720025 -1.2443125H5.5252625c-0.436875 -0.0002125 -0.8111625 -0.31264375 -0.8894375 -0.74245l-0.3015 -1.66958125h9.10014375c0.72858125 0.0001125 1.35298125 -0.52085625 1.48339375 -1.237675L15.8344375 3.5308125c0.0159125 -0.08805625 -0.0081125 -0.1786375 -0.065575 -0.24723125ZM6.79384375 14.02918125c0 0.92839375 -1.0050125 1.5086375 -1.809025 1.0444375 -0.8040125 -0.46419375 -0.8040125 -1.62468125 0 -2.088875 0.18331875 -0.10584375 0.391325 -0.16156875 0.60300625 -0.16158125 0.6660875 -0.000025 1.20601875 0.53993125 1.20601875 1.20601875Zm7.23609375 0c0 0.92839375 -1.0050125 1.5086375 -1.809025 1.0444375 -0.8040125 -0.46419375 -0.8040125 -1.62468125 0 -2.088875 0.18335625 -0.1058625 0.3912875 -0.1615875 0.60300625 -0.16158125 0.66604375 0.00003125 1.20601875 0.539975 1.20601875 1.20601875Zm0.29471875 -5.56651875c-0.078325 0.4300875 -0.45303125 0.74260625 -0.8901875 0.74245625H4.2220125L3.23534375 3.77805h11.9410625Z"
                                        stroke-width="0.0625"></path>
                                </svg>
                            </button>



                        </div>
                        <dialog id="my_modal_3" class="modal">
                            <div class="modal-box">
                                <form method="dialog">
                                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                </form>
                                <h3 class="text-lg font-bold">Keranjang Info</h3>
                                <p class="py-4">Produk Berhasil Ditambahkan</p>
                            </div>
                        </dialog>
                    </div>
                </div>
            </div>
        </div>

        <div id="payment-modal" class="fixed z-50 inset-0  hidden flex items-center justify-center overflow-auto"
            style="background-color: rgba(0,0,0,0.7);">
            <div class="bg-white rounded-2xl shadow-2xl w-1/3 p-6 relative border-l-4 border-green-500">
                <button onclick="closePaymentModal()"
                    class="absolute top-4 right-4 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-full w-8 h-8 flex items-center justify-center font-bold transition-all duration-200">&times;</button>

                <div class="flex items-center mb-4">
                    <div class="bg-green-500 rounded-full p-2 mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">Pembayaran QRIS</h2>
                </div>

                <!-- Compact Summary -->
                <div class="bg-gray-50 rounded-xl p-3 border border-gray-200 mb-4">
                    <div class="flex justify-between items-center text-sm">
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                            <span class="text-gray-700 truncate">{{ $product->nama_222405 }}</span>
                        </div>
                        <span class="text-green-600 font-bold">Rp
                            {{ number_format($product->harga_222405, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- QR Code Section - Initially Visible -->
                <div id="qr-section" class="transition-all duration-300">
                    <p class="text-gray-700 mb-3 font-medium text-sm">Scan kode QR di bawah ini untuk menyelesaikan
                        pembayaran:</p>

                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 mb-4">
                        <div class="flex justify-center">
                            <div class="bg-white p-2 rounded-xl shadow-md">
                                <img src="{{ asset('images/frame.png') }}" alt="QRIS" class="w-40 h-40">
                            </div>
                        </div>
                        <div class="text-center text-xs text-gray-500 mt-2 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Pastikan jumlah pembayaran sesuai dengan total
                        </div>
                    </div>

                    <!-- Show Upload Form Button -->
                    <div class="flex justify-center">
                        <button onclick="toggleUploadSection()"
                            class="bg-green-500 text-white font-medium py-2 px-4 rounded-xl hover:bg-green-600 transition-colors duration-200 shadow-md flex items-center text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            Sudah Bayar? Upload Bukti
                        </button>
                    </div>
                </div>

                <!-- Upload Section - Initially Hidden -->
                <div id="upload-section" class="hidden transition-all duration-300">
                    <form id="upload-receipt-form" enctype="multipart/form-data" class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2 flex items-center text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-green-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            Unggah Bukti Pembayaran:
                        </label>
                        <div
                            class="border-2 border-gray-200 border-dashed rounded-xl p-4 text-center hover:bg-gray-50 transition-colors duration-200">
                            <input type="file" name="receipt" id="receipt" class="hidden" accept="image/*"
                                required onchange="previewReceipt()">
                            <label for="receipt" class="cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-gray-400 mb-2"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <span class="text-gray-600 font-medium text-sm">Klik untuk memilih file</span>
                                <p class="text-xs text-gray-500 mt-1">JPG, PNG atau PDF (Maks. 5MB)</p>
                            </label>
                        </div>
                    </form>

                    <div id="receipt-preview" class="hidden mb-4">
                        <h3 class="font-semibold text-gray-700 mb-2 flex items-center text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-green-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Pratinjau Bukti Pembayaran:
                        </h3>
                        <div class="border border-gray-200 rounded-xl overflow-hidden">
                            <img id="receipt-image" src="" alt="Bukti Pembayaran" class="w-full">
                        </div>
                    </div>

                    <!-- Show QR Code Button -->
                    <div class="flex justify-center mb-4">
                        <button onclick="toggleUploadSection()"
                            class="bg-gray-100 text-gray-700 font-medium py-2 px-4 rounded-xl hover:bg-gray-200 transition-colors duration-200 flex items-center text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                            Kembali ke QRIS
                        </button>
                    </div>
                </div>

                <div class="flex justify-end space-x-3">

                    <button id="submit-button" onclick="submitPaymentProof()"
                        class="bg-green-500 text-white font-medium py-2 px-4 rounded-xl hover:bg-green-600 transition-colors duration-200 shadow-md flex items-center text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Kirim
                    </button>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script>
        function isUserLoggedIn() {
            return {{ auth()->check() ? 'true' : 'false' }};
        }

        document.getElementById('add-to-cart').addEventListener('click', function() {
            if (!isUserLoggedIn()) {
                window.location.href = "{{ route('login') }}";
                return;
            }

            const qty = parseInt(document.getElementById('qty').value);
            const productId = {{ $product->id_produk_222405 }};

            if (isNaN(qty) || qty < 1) {
                alert('Quantity harus minimal 1.');
                return;
            }
            console.log(qty)

            fetch(`{{ route('cart.add', ':id') }}`.replace(':id', productId), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        quantity: qty
                    })
                })
                .then(response => response.json())
                .then(() => document.getElementById('my_modal_3').showModal())
                .catch(console.error);
        });
    </script>
    <script>
        // Toggle Modal
        function toggleModal(modalId, show = true) {
            const modal = document.getElementById(modalId);
            modal.classList.toggle('hidden', !show);
        }

        function showPaymentModal() {
            if (!isUserLoggedIn()) {
                // Jika pengguna belum login, arahkan ke halaman login
                window.location.href = "{{ route('login') }}";
                return; // Hentikan eksekusi fungsi
            }
            document.getElementById('payment-modal').classList.remove('hidden');
        }

        function toggleUploadSection() {
            const qrSection = document.getElementById('qr-section');
            const uploadSection = document.getElementById('upload-section');

            if (qrSection.classList.contains('hidden')) {
                // Show QR section, hide upload section
                qrSection.classList.remove('hidden');
                uploadSection.classList.add('hidden');
            } else {
                // Show upload section, hide QR section
                qrSection.classList.add('hidden');
                uploadSection.classList.remove('hidden');
            }
        }


        function closePaymentModal() {
            document.getElementById('payment-modal').classList.add('hidden');
        }

        function isUserLoggedIn() {
            return {{ auth()->check() ? 'true' : 'false' }};
        }


        // Receipt Preview
        function previewReceipt() {
            const receiptInput = document.getElementById('receipt');
            const receiptPreview = document.getElementById('receipt-preview');
            const receiptImage = document.getElementById('receipt-image');

            if (receiptInput.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    receiptImage.src = e.target.result;
                    receiptPreview.classList.remove('hidden');
                };
                reader.readAsDataURL(receiptInput.files[0]);
            } else {
                receiptPreview.classList.add('hidden');
            }
        }

        // Submit Payment Proof

        document.getElementById('increment').addEventListener('click', function() {
            let qty = document.getElementById('qty');
            qty.value = parseInt(qty.value) + 1;
        });

        document.getElementById('decrement').addEventListener('click', function() {
            let qty = document.getElementById('qty');
            if (qty.value > 1) {
                qty.value = parseInt(qty.value) - 1;
            }
        });

        const sizeButtons = document.querySelectorAll('.size-btn');

        sizeButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Reset semua tombol ke keadaan awal
                sizeButtons.forEach(btn => {
                    btn.classList.remove('bg-black', 'text-white');
                    btn.classList.add('bg-white', 'text-gray-700', 'border-gray-500');
                });

                // Tambahkan kelas untuk tombol yang diklik
                button.classList.remove('bg-white', 'text-gray-700', 'border-gray-500');
                button.classList.add('bg-black', 'text-white');
            });
        });
    </script>
    <script>
        async function submitPaymentProof() {
            if (!isUserLoggedIn()) {
                // Jika pengguna belum login, arahkan ke halaman login
                window.location.href = "{{ route('login') }}";
                return; // Hentikan eksekusi fungsi
            }

            const formData = new FormData(document.getElementById('upload-receipt-form'));
            const productId = {{ $product->id_produk_222405 }};
            const quantity = parseInt(document.getElementById('qty').value);

            formData.append('product_id', productId);
            formData.append('quantity', quantity);

            try {
                const response = await fetch(`{{ route('checkout.single', ':productId') }}`.replace(':productId',
                    productId), {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData,
                });

                if (response.ok) {
                    alert('Payment proof submitted successfully!');
                    toggleModal('payment-modal', false);
                    window.location.reload();
                } else {
                    const errorData = await response.json();
                    alert(`Failed to submit payment proof: ${errorData.message}`);
                    window.location.reload();
                }
            } catch (error) {
                console.error(error);
                alert('Error submitting payment proof.');
            }
        }
    </script>
@endsection
