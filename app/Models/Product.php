<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table      = 'produk_222405';
    public $timestamps    = false;
    protected $primaryKey = 'id_produk_222405';
    public $incrementing  = false;  // Penting agar Laravel tidak menganggap ID auto-increment
    protected $keyType    = 'string';  // Karena UUID adalah string

    protected $fillable = [
        'id_produk_222405',
        'nama_222405',
        'deskripsi_222405',
        'harga_222405',
        'id_kategori_222405',
        'path_img_222405',
        'jumlah_222405',
        'created_at_222405'
    ];

    public function category()
    {
        return $this->belongsTo(CategoryProduct::class, 'id_kategori_222405', 'id_kategori_222405');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_produk_222405', 'id_produk_222405');
    }
}
