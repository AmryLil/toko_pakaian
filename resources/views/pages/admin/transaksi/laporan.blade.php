@extends('layouts.dashboard-layout')

@section('content')
    <div class="container pt-24 mx-auto px-4">
        <h1 class="mb-4 text-3xl font-bold text-gray-800">Laporan Transaksi</h1>

        <form action="{{ route('admin.transaksi.laporan') }}" method="GET"
            class="flex flex-wrap items-center gap-4 mb-8 p-6 bg-white shadow-md rounded-lg">
            <div class="flex-1 min-w-[200px]">
                <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                <input type="date" id="start_date" name="start_date"
                    class="form-control border border-gray-300 rounded-md p-2 w-full focus:ring-2 focus:ring-indigo-500"
                    value="{{ request('start_date') }}">
            </div>
            <div class="flex-1 min-w-[200px]">
                <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai</label>
                <input type="date" id="end_date" name="end_date"
                    class="form-control border border-gray-300 rounded-md p-2 w-full focus:ring-2 focus:ring-indigo-500"
                    value="{{ request('end_date') }}">
            </div>
            <div class="mt-auto">
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2.5 rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out mt-7">
                    Terapkan Filter
                </button>
            </div>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white shadow-lg rounded-lg p-6 flex items-center">
                <div class="bg-blue-100 text-blue-600 p-4 rounded-full mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Pelanggan Teratas</h3>
                    @if ($pelangganTeratas)
                        <p class="text-xl font-bold text-gray-800">{{ $pelangganTeratas->name_222405 }}</p>
                        <p class="text-sm text-gray-600">{{ $pelangganTeratas->total_transaksi }} Transaksi</p>
                    @else
                        <p class="text-lg font-semibold text-gray-400">Tidak Ada Data</p>
                    @endif
                </div>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-6 flex items-center">
                <div class="bg-yellow-100 text-yellow-600 p-4 rounded-full mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Produk Terlaris</h3>
                    @if ($produkTerlaris)
                        <p class="text-xl font-bold text-gray-800">{{ $produkTerlaris->nama_222405 }}</p>
                        <p class="text-sm text-gray-600">{{ $produkTerlaris->total_terjual }} Unit Terjual</p>
                    @else
                        <p class="text-lg font-semibold text-gray-400">Tidak Ada Data</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-6 mb-8 flex flex-wrap justify-between items-center gap-4">
            <div>
                <strong class="text-lg text-gray-700">Total Nilai Transaksi:</strong>
                <span class="text-3xl font-bold text-green-600 ml-2">Rp
                    {{ number_format($totalTransaksi, 0, ',', '.') }}</span>
            </div>
            <div>
                <a href="{{ route('admin.transaksi.pdf', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                    class="bg-red-600 text-white px-6 py-3 rounded-md shadow-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-300 ease-in-out flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Unduh PDF
                </a>
            </div>
        </div>

        <div class="overflow-x-auto bg-white p-4 rounded-lg shadow-lg">
            <table class="table-auto w-full text-sm text-gray-600 rounded-xl">
                <thead class="bg-gray-200 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3 text-left">#</th>
                        <th class="px-6 py-3 text-left">Pelanggan</th>
                        <th class="px-6 py-3 text-left">Produk</th>
                        <th class="px-6 py-3 text-left">Jumlah</th>
                        <th class="px-6 py-3 text-left">Harga Total</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse ($transaksi as $item)
                        <tr class="border-b hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">{{ $item->pelanggan->name_222405 ?? 'N/A' }}</td>
                            <td class="px-6 py-4">{{ $item->produk->nama_222405 ?? 'N/A' }}</td>
                            <td class="px-6 py-4">{{ $item->jumlah_222405 }}</td>
                            <td class="px-6 py-4 font-semibold">Rp
                                {{ number_format($item->harga_total_222405, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 text-xs font-medium rounded-full 
                                    {{ $item->status_222405 == 'paid'
                                        ? 'bg-green-100 text-green-800'
                                        : ($item->status_222405 == 'pending'
                                            ? 'bg-yellow-100 text-yellow-800'
                                            : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($item->status_222405) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($item->tanggal_transaksi_222405)->format('d-m-Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-8 text-gray-500">
                                Tidak ada data transaksi yang sesuai dengan filter yang dipilih.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
