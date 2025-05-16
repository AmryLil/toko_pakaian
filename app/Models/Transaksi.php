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
    public $incrementing  = false;  // Penting agar Laravel tidak menganggap ID auto-increment
    protected $keyType    = 'string';  // Karena UUID adalah string

    protected $fillable = [
        'id_user_222405',
        'jumlah_222405',
        'id_produk_222405',
        'harga_total_222405',
        'status_222405',
        'bukti_tf_222405',
        'tanggal_transaksi_222405'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(User::class, 'id_user_222405', 'id_user_222405');
    }

    /**
     * Relasi ke Product (Produk).
     * Setiap transaksi memiliki satu produk.
     */
    public function produk()
    {
        return $this->belongsTo(Product::class, 'id_produk_222405', 'id_produk_222405');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_produk_222405');  // Sesuaikan nama kolom foreign key
    }

    // Relasi ke pelanggan
}
