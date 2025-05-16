<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;

    protected $table      = 'kategori_produk_222405';  // Nama tabel kategori
    protected $primaryKey = 'id_kategori_222405';
    public $timestamps    = false;
    public $incrementing  = false;  // Penting agar Laravel tidak menganggap ID auto-increment
    protected $keyType    = 'string';  // Karena UUID adalah string

    protected $fillable = [
        'id_kategori_222405',
        'nama_222405',
        'deskripsi_222405',
        'path_img_222405'
    ];

    // Relasi one-to-many dengan produk
    public function products()
    {
        return $this->hasMany(Product::class, 'kategori_id', 'id');
    }
}
