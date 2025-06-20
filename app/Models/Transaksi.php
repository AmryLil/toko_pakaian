<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table      = 'transaksi_222405';
    protected $primaryKey = 'id_transaksi_222405';
    public $incrementing  = false;  // Karena kita generate ID custom
    protected $keyType    = 'string';  // ID berupa string

    protected $fillable = [
        'id_transaksi_222405',  // Tambahkan ini agar bisa diisi
        'email_222405',
        'jumlah_222405',
        'id_produk_222405',
        'harga_total_222405',
        'status_222405',
        'bukti_tf_222405',
        'tanggal_transaksi_222405'
    ];

    protected $casts = [
        'tanggal_transaksi_222405' => 'datetime',
        'harga_total_222405'       => 'decimal:2',
        'jumlah_222405'            => 'integer'
    ];

    /**
     * Boot method untuk generate ID otomatis
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id_transaksi_222405)) {
                $model->id_transaksi_222405 = self::generateTransactionId();
            }

            // Set tanggal transaksi jika belum ada
            if (empty($model->tanggal_transaksi_222405)) {
                $model->tanggal_transaksi_222405 = Carbon::now();
            }
        });
    }

    /**
     * Generate ID transaksi dengan format: TRX-YYYYMMDD-HHMMSS-XXX
     * Contoh: TRX-20241225-143022-001
     */
    private static function generateTransactionId()
    {
        $date       = Carbon::now();
        $dateString = $date->format('Ymd');
        $timeString = $date->format('His');

        // Cari transaksi terakhir hari ini
        $lastTransaction = self::where('id_transaksi_222405', 'like', "TRX-{$dateString}-%")
            ->orderBy('id_transaksi_222405', 'desc')
            ->first();

        if ($lastTransaction) {
            // Ambil nomor urut terakhir
            $lastId     = $lastTransaction->id_transaksi_222405;
            $lastNumber = (int) substr($lastId, -3);  // Ambil 3 digit terakhir
            $newNumber  = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        // Format dengan 3 digit (001, 002, dst)
        $sequence = str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        return "TRX-{$dateString}-{$timeString}-{$sequence}";
    }

    /**
     * Alternative method untuk generate ID dengan format yang lebih sederhana
     * Format: TR-YYYYMMDD-XXXXX
     * Contoh: TR-20241225-00001
     */
    private static function generateSimpleTransactionId()
    {
        $date = Carbon::now()->format('Ymd');

        // Cari transaksi terakhir hari ini
        $lastTransaction = self::where('id_transaksi_222405', 'like', "TR-{$date}-%")
            ->orderBy('id_transaksi_222405', 'desc')
            ->first();

        if ($lastTransaction) {
            $lastId     = $lastTransaction->id_transaksi_222405;
            $lastNumber = (int) substr($lastId, -5);  // Ambil 5 digit terakhir
            $newNumber  = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        // Format dengan 5 digit (00001, 00002, dst)
        $sequence = str_pad($newNumber, 5, '0', STR_PAD_LEFT);

        return "TR-{$date}-{$sequence}";
    }

    /**
     * Method untuk generate ID dengan format incremental
     * Format: TXN-XXXXXXX
     * Contoh: TXN-0000001
     */
    private static function generateIncrementalId()
    {
        $lastTransaction = self::orderBy('id_transaksi_222405', 'desc')->first();

        if ($lastTransaction) {
            $lastId     = $lastTransaction->id_transaksi_222405;
            $lastNumber = (int) substr($lastId, 4);  // Ambil angka setelah "TXN-"
            $newNumber  = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        // Format dengan 7 digit
        $sequence = str_pad($newNumber, 7, '0', STR_PAD_LEFT);

        return "TXN-{$sequence}";
    }

    /**
     * Relasi ke User (Pelanggan).
     * Setiap transaksi dimiliki oleh satu pelanggan.
     */
    public function pelanggan()
    {
        return $this->belongsTo(User::class, 'email_222405', 'email_222405');
    }

    /**
     * Relasi ke Product (Produk).
     * Setiap transaksi memiliki satu produk.
     */
    public function produk()
    {
        return $this->belongsTo(Product::class, 'id_produk_222405', 'id_produk_222405');
    }

    /**
     * Alias untuk relasi produk (untuk konsistensi)
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_produk_222405', 'id_produk_222405');
    }

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status_222405', $status);
    }

    /**
     * Scope untuk filter berdasarkan tanggal
     */
    public function scopeByDate($query, $date)
    {
        return $query->whereDate('tanggal_transaksi_222405', $date);
    }

    /**
     * Scope untuk filter berdasarkan range tanggal
     */
    public function scopeByDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('tanggal_transaksi_222405', [$startDate, $endDate]);
    }

    /**
     * Accessor untuk format harga total
     */
    public function getFormattedHargaTotalAttribute()
    {
        return 'Rp ' . number_format($this->harga_total_222405, 0, ',', '.');
    }

    /**
     * Accessor untuk format tanggal transaksi
     */
    public function getFormattedTanggalAttribute()
    {
        return Carbon::parse($this->tanggal_transaksi_222405)->format('d/m/Y H:i:s');
    }

    /** Mutator untuk set status dengan validasi */

    /**
     * Method untuk mengecek apakah transaksi sudah dibayar
     */
    public function isPaid()
    {
        return $this->status_222405 === 'paid';
    }

    /**
     * Method untuk mengecek apakah transaksi masih pending
     */
    public function isPending()
    {
        return $this->status_222405 === 'pending';
    }

    /**
     * Method untuk mengecek apakah transaksi dibatalkan
     */
    public function isCancelled()
    {
        return $this->status_222405 === 'cancelled';
    }
}
