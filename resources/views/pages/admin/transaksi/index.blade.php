@extends('layouts.dashboard-layout')

@section('content')
    <div class="container mx-auto py-6 rounded-md pt-20">
        <!-- Header -->
        <div class="flex justify-between items-center mb-4 p-4 text-white rounded-t-xl" style="background-color: #20750b;">
            <h1 class="text-3xl font-bold text-slate-50">Kelola Semua Transaksi</h1>
        </div>

        <!-- Transaksi Table -->
        <div class="overflow-x-auto bg-slate-50 p-4 rounded-lg shadow-lg">
            <table class="table-auto w-full text-sm text-gray-600 rounded-xl overflow-hidden">
                <thead class="bg-gray-200 text-gray-800 text-lg">
                    <tr>
                        <th class="px-5 py-3 text-left">No</th>
                        <th class="px-5 py-3 text-left">Pelanggan</th>
                        <th class="px-5 py-3 text-left">Produk</th>
                        <th class="px-5 py-3 text-left">Jumlah</th>
                        <th class="px-5 py-3 text-left">Harga</th>
                        <th class="px-5 py-3 text-left">Status</th>
                        <th class="px-5 py-3 text-left">Tanggal</th>
                        <th class="px-5 py-3 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse ($transaksi as $item)
                        <tr class="border-b hover:bg-slate-50 transition-all duration-300">
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">{{ $item->pelanggan->name_222405 ?? 'Nama Tidak Ditemukan' }}</td>
                            <td class="px-6 py-4">{{ $item->produk->nama_222405 ?? 'Produk Tidak Ditemukan' }}</td>
                            <td class="px-6 py-4">{{ $item->jumlah_222405 }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($item->harga_total_222405, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <select
                                    class="status-dropdown p-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-200 rounded-lg shadow-sm"
                                    data-id="{{ $item->id_transaksi_222405 }}"
                                    data-original-status="{{ $item->status_222405 }}" onchange="updateStatus(this)">
                                    <option value="pending" {{ $item->status_222405 == 'pending' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="dikemas" {{ $item->status_222405 == 'dikemas' ? 'selected' : '' }}>
                                        Dikemas</option>
                                    <option value="dikirim" {{ $item->status_222405 == 'dikirim' ? 'selected' : '' }}>
                                        Dikirim</option>
                                    <option value="selesai" {{ $item->status_222405 == 'selesai' ? 'selected' : '' }}>
                                        Selesai</option>
                                </select>
                            </td>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($item->tanggal_transaksi_222405)->format('d-m-Y') }}</td>
                            <td class="px-6 py-4 flex gap-1">
                                <button onclick="showBuktiTF('{{ asset('storage/' . $item->bukti_tf_222405) }}')"
                                    class="p-2 text-gray-700 hover:text-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </button>
                                <form action="{{ route('admin.transaksi.destroy', $item->id_transaksi_222405) }}"
                                    method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-700 hover:text-red-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.134-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.067-2.09 1.02-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-gray-500">Tidak ada data transaksi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal untuk menampilkan bukti TF -->
    <div id="buktiTFModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-xl relative">
            <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800" onclick="tutup()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <h2 class="text-xl font-bold mb-4">Bukti Transfer</h2>
            <img id="buktiTFImage" src="" alt="Bukti Transfer" class="rounded-md w-full">
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function updateStatus(selectElement) {
            const newStatus = selectElement.value;
            const originalStatus = selectElement.getAttribute('data-original-status');
            const transaksiId = selectElement.getAttribute('data-id');

            console.log(transaksiId)

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: `Status transaksi akan diubah menjadi "${newStatus}".`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, ubah!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kirim request PATCH ke server
                    fetch(`/admin/transaksi/${transaksiId}/update-status`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                status: newStatus
                            })
                        })
                        .then(response => response.json()) // Selalu parse JSON untuk mendapatkan detailnya
                        .then(data => {
                            // Cek properti 'success' dari JSON yang dikirim backend
                            if (data.success) {
                                Swal.fire(
                                    'Berhasil!',
                                    data.message, // Gunakan pesan dari backend
                                    'success'
                                );
                                // Perbarui status original di atribut data agar konsisten
                                selectElement.setAttribute('data-original-status', newStatus);
                            } else {
                                // Jika gagal, tampilkan pesan error dari backend
                                Swal.fire(
                                    'Gagal!',
                                    data.message || 'Terjadi kesalahan.', // Fallback message
                                    'error'
                                );
                                // Kembalikan dropdown ke status semula
                                selectElement.value = originalStatus;
                            }
                        })
                        .catch(error => {
                            // Tangani error jaringan atau parsing
                            console.error('Error:', error);
                            Swal.fire('Error Jaringan', 'Gagal terhubung ke server.', 'error');
                            // Kembalikan dropdown ke status semula
                            selectElement.value = originalStatus;
                        });
                } else {
                    // Jika user menekan "Batal", kembalikan dropdown ke status semula
                    selectElement.value = originalStatus;
                }
            });
        }

        function showBuktiTF(imageUrl) {
            const modal = document.getElementById('buktiTFModal');
            const img = document.getElementById('buktiTFImage');
            img.src = imageUrl;
            modal.classList.remove('hidden');
        }

        function tutup() {
            const modal = document.getElementById('buktiTFModal');
            modal.classList.add('hidden');
        }
    </script>
@endsection
