<?php

namespace Database\Seeders;

use App\Models\CategoryProduct;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'id_kategori_222405' => Str::uuid()->toString(),
                'nama_222405'        => 'Tops',
                'deskripsi_222405'   => 'T-shirts, blouses, shirts and more',
                'path_img_222405'    => 'kategori/tops.jpg',
            ],
            [
                'id_kategori_222405' => Str::uuid()->toString(),
                'nama_222405'        => 'Pants',
                'deskripsi_222405'   => 'Jeans, trousers, shorts and more',
                'path_img_222405'    => 'kategori/pants.jpg',
            ],
            [
                'id_kategori_222405' => Str::uuid()->toString(),
                'nama_222405'        => 'Dresses',
                'deskripsi_222405'   => 'Casual, formal and party dresses',
                'path_img_222405'    => 'kategori/dresses.jpg',
            ],
            [
                'id_kategori_222405' => Str::uuid()->toString(),
                'nama_222405'        => 'Outerwear',
                'deskripsi_222405'   => 'Jackets, coats, sweaters and cardigans',
                'path_img_222405'    => 'kategori/outerwear.jpg',
            ],
            [
                'id_kategori_222405' => Str::uuid()->toString(),
                'nama_222405'        => 'Activewear',
                'deskripsi_222405'   => 'Sports and athletic clothing',
                'path_img_222405'    => 'kategori/activewear.jpg',
            ],
            [
                'id_kategori_222405' => Str::uuid()->toString(),
                'nama_222405'        => 'Accessories',
                'deskripsi_222405'   => 'Hats, scarves, belts and more',
                'path_img_222405'    => 'kategori/accessories.jpg',
            ],
        ];

        foreach ($categories as $category) {
            CategoryProduct::create($category);
        }
    }
}
