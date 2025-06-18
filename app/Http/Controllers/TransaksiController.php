<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaksi;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use Exception;

class TransaksiController extends Controller
{
    public function index()
    {
        $userId = session('email');

        $transaksiList = Transaksi::where('email_222405', $userId)
            ->where('status_222405', 'selesai')
            ->get();

        // No need for product exploding since your model already has a relationship
        foreach ($transaksiList as $transaksi) {
            // Use the relationship defined in the model
            $transaksi->produk = $transaksi->produk();
        }

        return view('pages.users.riwayat', compact('transaksiList'));
    }

    public function showPesanan()
    {
        $userId        = session('email');
        $transaksiList = Transaksi::with('produk')  // Using the relationship defined in the model
            ->where('email_222405', $userId)
            ->whereIn('status_222405', ['pending', 'dikemas', 'dikirim'])
            ->get();

        return view('pages.users.pesanan', compact('transaksiList'));
    }

    public function updateStatusByUser(Request $request, $id)
    {
        // Cari transaksi berdasarkan ID
        $transaksi = Transaksi::findOrFail($id);

        // Periksa apakah status saat ini adalah 'dikirim'
        if ($transaksi->status_222405 === 'dikirim') {
            // Ubah status menjadi 'diterima'
            $transaksi->status_222405 = 'selesai';
            $transaksi->save();

            return redirect()->route('pesanan')->with('success', 'Pesanan telah diterima.');
        }

        return redirect()->route('pages.users.pesanan')->with('error', 'Status pesanan tidak valid.');
    }

    public function showAll()
    {
        // Ambil semua transaksi beserta relasi pelanggan dan produk
        $transaksi = Transaksi::with(['pelanggan', 'produk'])->get();

        return view('pages.admin.transaksi.index', compact('transaksi'));
    }

    // Mengupdate status transaksi

    public function updateStatus(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'status' => 'required|in:pending,dikemas,dikirim,selesai',
            ]);

            $transaksi  = Transaksi::where('id_transaksi_222405', $id)->firstOrFail();
            $statusLama = $transaksi->status_222405;

            $transaksi->status_222405 = $validated['status'];

            if ($transaksi->save()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Status transaksi berhasil diperbarui',
                ]);
            } else {
                Log::error("Gagal menyimpan transaksi ID: {$id}. Metode save() mengembalikan false. Kemungkinan ada model event yang membatalkan.");
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menyimpan data. Kemungkinan dibatalkan oleh sebuah event. Silakan cek log.',
                ], 500);  // 500 Internal Server Error
            }
        } catch (ValidationException $e) {
            Log::warning("Gagal validasi update status untuk ID {$id}: ", $e->errors());
            return response()->json([
                'success' => false,
                'message' => 'Data yang dikirim tidak valid.',
                'errors'  => $e->errors(),
            ], 422);
        } catch (ModelNotFoundException $e) {
            Log::error("Transaksi tidak ditemukan saat update status: ID {$id}");
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan'
            ], 404);
        } catch (Exception $e) {
            Log::error("Error saat update status untuk ID {$id}: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan pada server.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    private function getLaporanData(Request $request)
    {
        $filter    = $request->input('filter');
        $startDate = $request->input('start_date');
        $endDate   = $request->input('end_date');

        // --- BAGIAN BARU: Logika untuk Filter Cepat ---
        if ($filter) {
            switch ($filter) {
                case 'today':
                    $startDate = Carbon::today()->toDateString();
                    $endDate   = Carbon::today()->toDateString();
                    break;
                case 'week':
                    $startDate = Carbon::now()->startOfWeek()->toDateString();
                    $endDate   = Carbon::now()->endOfWeek()->toDateString();
                    break;
                case 'month':
                    $startDate = Carbon::now()->startOfMonth()->toDateString();
                    $endDate   = Carbon::now()->endOfMonth()->toDateString();
                    break;
                case 'year':
                    $startDate = Carbon::now()->startOfYear()->toDateString();
                    $endDate   = Carbon::now()->endOfYear()->toDateString();
                    break;
            }
        }
        // --- AKHIR BAGIAN BARU ---

        // Query utama
        $query = Transaksi::with(['pelanggan', 'produk'])->orderBy('tanggal_transaksi_222405', 'desc');
        if ($startDate)
            $query->whereDate('tanggal_transaksi_222405', '>=', $startDate);
        if ($endDate)
            $query->whereDate('tanggal_transaksi_222405', '<=', $endDate);

        $transaksis = $query->get();

        // Statistik Pelanggan Teratas
        $pelangganTeratasQuery = Transaksi::query()->select('email_222405', DB::raw('COUNT(*) as total_transaksi'))->groupBy('email_222405')->orderBy('total_transaksi', 'desc');
        if ($startDate)
            $pelangganTeratasQuery->whereDate('tanggal_transaksi_222405', '>=', $startDate);
        if ($endDate)
            $pelangganTeratasQuery->whereDate('tanggal_transaksi_222405', '<=', $endDate);
        $pelangganTeratasData = $pelangganTeratasQuery->first();
        $pelangganTeratas     = $pelangganTeratasData ? User::find($pelangganTeratasData->email_222405) : null;
        if ($pelangganTeratas)
            $pelangganTeratas->total_transaksi = $pelangganTeratasData->total_transaksi;

        // Statistik Produk Terlaris
        $produkTerlarisQuery = Transaksi::query()->select('id_produk_222405', DB::raw('SUM(jumlah_222405) as total_terjual'))->groupBy('id_produk_222405')->orderBy('total_terjual', 'desc');
        if ($startDate)
            $produkTerlarisQuery->whereDate('tanggal_transaksi_222405', '>=', $startDate);
        if ($endDate)
            $produkTerlarisQuery->whereDate('tanggal_transaksi_222405', '<=', $endDate);
        $produkTerlarisData = $produkTerlarisQuery->first();
        $produkTerlaris     = $produkTerlarisData ? Product::find($produkTerlarisData->id_produk_222405) : null;
        if ($produkTerlaris)
            $produkTerlaris->total_terjual = $produkTerlarisData->total_terjual;

        return [
            'transaksis'       => $transaksis,
            'totalTransaksi'   => $transaksis->sum('harga_total_222405'),
            'pelangganTeratas' => $pelangganTeratas,
            'produkTerlaris'   => $produkTerlaris,
            'startDate'        => $startDate,
            'endDate'          => $endDate,
        ];
    }

    /**
     * Menampilkan halaman laporan.
     */
    public function showAllLaporan(Request $request)
    {
        $data = $this->getLaporanData($request);
        return view('pages.admin.transaksi.laporan', $data);
    }

    // ... method generatePdf() akan kita ubah nanti

    /**
     * Men-generate dan men-download laporan dalam format PDF.
     */
    public function generatePdf(Request $request)
    {
        // Ambil parameter start_date dan end_date dari request
        $startDate = $request->input('start_date');
        $endDate   = $request->input('end_date');

        // Query untuk daftar transaksi
        $query = Transaksi::with(['pelanggan', 'produk'])->orderBy('tanggal_transaksi_222405', 'desc');
        if ($startDate) {
            $query->where('tanggal_transaksi_222405', '>=', $startDate);
        }
        if ($endDate) {
            $query->where('tanggal_transaksi_222405', '<=', $endDate);
        }
        $transaksis     = $query->get();
        $totalTransaksi = $transaksis->sum('harga_total_222405');

        // Pelanggan Teratas
        $pelangganTeratasQuery = Transaksi::query()->select('email_222405', DB::raw('COUNT(id_transaksi_222405) as total_transaksi'))->groupBy('email_222405')->orderBy('total_transaksi', 'desc');
        if ($startDate) {
            $pelangganTeratasQuery->where('tanggal_transaksi_222405', '>=', $startDate);
        }
        if ($endDate) {
            $pelangganTeratasQuery->where('tanggal_transaksi_222405', '<=', $endDate);
        }
        $pelangganTeratasData = $pelangganTeratasQuery->first();
        $pelangganTeratas     = $pelangganTeratasData ? User::find($pelangganTeratasData->email_222405) : null;
        if ($pelangganTeratas) {
            $pelangganTeratas->total_transaksi = $pelangganTeratasData->total_transaksi;
        }

        // Produk Terlaris (KODE YANG SUDAH DIPERBAIKI)
        $produkTerlarisQuery = Transaksi::query()
            ->select('id_produk_222405', DB::raw('SUM(jumlah_222405) as total_terjual'))  // <-- PERBAIKAN DI SINI
            ->groupBy('id_produk_222405')
            ->orderBy('total_terjual', 'desc');
        if ($startDate) {
            $produkTerlarisQuery->where('tanggal_transaksi_222405', '>=', $startDate);
        }
        if ($endDate) {
            $produkTerlarisQuery->where('tanggal_transaksi_222405', '<=', $endDate);
        }
        $produkTerlarisData = $produkTerlarisQuery->first();
        $produkTerlaris     = $produkTerlarisData ? Product::find($produkTerlarisData->id_produk_222405) : null;
        if ($produkTerlaris) {
            $produkTerlaris->total_terjual = $produkTerlarisData->total_terjual;
        }

        // Buat data untuk dikirim ke view PDF
        $data = [
            'transaksis'       => $transaksis,
            'totalTransaksi'   => $totalTransaksi,
            'pelangganTeratas' => $pelangganTeratas,
            'produkTerlaris'   => $produkTerlaris,
            'startDate'        => $startDate,
            'endDate'          => $endDate,
        ];

        $pdf      = Pdf::loadView('pages.admin.transaksi.pdf', $data);  // Sesuaikan path view Anda
        $filename = 'Laporan-Transaksi-' . now()->format('d-m-Y') . '.pdf';
        return $pdf->download($filename);
    }

    public function destroy($id)
    {
        // Temukan transaksi berdasarkan ID
        $transaksi = Transaksi::findOrFail($id);

        // Hapus transaksi
        $transaksi->delete();

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Transaksi berhasil dihapus.');
    }
}
