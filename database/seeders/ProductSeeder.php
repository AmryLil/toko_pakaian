<?php

namespace Database\Seeders;

use App\Models\CategoryProduct;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all category IDs
        $categories = CategoryProduct::all();

        $products = [];

        // Products for Tops category
        $topsCategory = $categories->where('nama_222405', 'Tops')->first();
        if ($topsCategory) {
            $products[] = [
                'id_produk_222405'   => Str::uuid()->toString(),
                'nama_222405'        => 'Classic Cotton T-Shirt',
                'deskripsi_222405'   => 'Comfortable everyday cotton t-shirt with a classic fit.',
                'harga_222405'       => 149000,
                'id_kategori_222405' => $topsCategory->id_kategori_222405,
                'path_img_222405'    => 'produk/tshirt_classic.jpg',
                'jumlah_222405'      => 100,
                'created_at_222405'  => Carbon::now()->toDateTimeString()
            ];

            $products[] = [
                'id_produk_222405'   => Str::uuid()->toString(),
                'nama_222405'        => 'Floral Blouse',
                'deskripsi_222405'   => 'Elegant floral pattern blouse with short sleeves.',
                'harga_222405'       => 279000,
                'id_kategori_222405' => $topsCategory->id_kategori_222405,
                'path_img_222405'    => 'produk/blouse_floral.jpg',
                'jumlah_222405'      => 75,
                'created_at_222405'  => Carbon::now()->toDateTimeString()
            ];

            $products[] = [
                'id_produk_222405'   => Str::uuid()->toString(),
                'nama_222405'        => 'Button-Up Shirt',
                'deskripsi_222405'   => 'Formal button-up shirt perfect for office wear.',
                'harga_222405'       => 329000,
                'id_kategori_222405' => $topsCategory->id_kategori_222405,
                'path_img_222405'    => 'produk/shirt_button.jpg',
                'jumlah_222405'      => 60,
                'created_at_222405'  => Carbon::now()->toDateTimeString()
            ];
        }

        // Products for Pants category
        $pantsCategory = $categories->where('nama_222405', 'Pants')->first();
        if ($pantsCategory) {
            $products[] = [
                'id_produk_222405'   => Str::uuid()->toString(),
                'nama_222405'        => 'Slim Fit Jeans',
                'deskripsi_222405'   => 'Classic slim fit jeans with a modern touch.',
                'harga_222405'       => 399000,
                'id_kategori_222405' => $pantsCategory->id_kategori_222405,
                'path_img_222405'    => 'produk/jeans_slim.jpg',
                'jumlah_222405'      => 85,
                'created_at_222405'  => Carbon::now()->toDateTimeString()
            ];

            $products[] = [
                'id_produk_222405'   => Str::uuid()->toString(),
                'nama_222405'        => 'Chino Pants',
                'deskripsi_222405'   => 'Versatile chino pants for casual and semi-formal occasions.',
                'harga_222405'       => 349000,
                'id_kategori_222405' => $pantsCategory->id_kategori_222405,
                'path_img_222405'    => 'produk/pants_chino.jpg',
                'jumlah_222405'      => 70,
                'created_at_222405'  => Carbon::now()->toDateTimeString()
            ];
        }

        // Products for Dresses category
        $dressesCategory = $categories->where('nama_222405', 'Dresses')->first();
        if ($dressesCategory) {
            $products[] = [
                'id_produk_222405'   => Str::uuid()->toString(),
                'nama_222405'        => 'Summer Maxi Dress',
                'deskripsi_222405'   => 'Flowing maxi dress perfect for summer occasions.',
                'harga_222405'       => 499000,
                'id_kategori_222405' => $dressesCategory->id_kategori_222405,
                'path_img_222405'    => 'produk/dress_maxi.jpg',
                'jumlah_222405'      => 50,
                'created_at_222405'  => Carbon::now()->toDateTimeString()
            ];

            $products[] = [
                'id_produk_222405'   => Str::uuid()->toString(),
                'nama_222405'        => 'Cocktail Dress',
                'deskripsi_222405'   => 'Elegant cocktail dress for formal events.',
                'harga_222405'       => 699000,
                'id_kategori_222405' => $dressesCategory->id_kategori_222405,
                'path_img_222405'    => 'produk/dress_cocktail.jpg',
                'jumlah_222405'      => 40,
                'created_at_222405'  => Carbon::now()->toDateTimeString()
            ];
        }

        // Products for Outerwear category
        $outerwearCategory = $categories->where('nama_222405', 'Outerwear')->first();
        if ($outerwearCategory) {
            $products[] = [
                'id_produk_222405'   => Str::uuid()->toString(),
                'nama_222405'        => 'Denim Jacket',
                'deskripsi_222405'   => 'Classic denim jacket that never goes out of style.',
                'harga_222405'       => 599000,
                'id_kategori_222405' => $outerwearCategory->id_kategori_222405,
                'path_img_222405'    => 'produk/jacket_denim.jpg',
                'jumlah_222405'      => 55,
                'created_at_222405'  => Carbon::now()->toDateTimeString()
            ];

            $products[] = [
                'id_produk_222405'   => Str::uuid()->toString(),
                'nama_222405'        => 'Wool Coat',
                'deskripsi_222405'   => 'Warm wool coat for cold winter days.',
                'harga_222405'       => 1299000,
                'id_kategori_222405' => $outerwearCategory->id_kategori_222405,
                'path_img_222405'    => 'produk/coat_wool.jpg',
                'jumlah_222405'      => 30,
                'created_at_222405'  => Carbon::now()->toDateTimeString()
            ];
        }

        // Products for Activewear category
        $activewearCategory = $categories->where('nama_222405', 'Activewear')->first();
        if ($activewearCategory) {
            $products[] = [
                'id_produk_222405'   => Str::uuid()->toString(),
                'nama_222405'        => 'Yoga Pants',
                'deskripsi_222405'   => 'Comfortable yoga pants with moisture-wicking fabric.',
                'harga_222405'       => 299000,
                'id_kategori_222405' => $activewearCategory->id_kategori_222405,
                'path_img_222405'    => 'produk/pants_yoga.jpg',
                'jumlah_222405'      => 90,
                'created_at_222405'  => Carbon::now()->toDateTimeString()
            ];

            $products[] = [
                'id_produk_222405'   => Str::uuid()->toString(),
                'nama_222405'        => 'Sport T-Shirt',
                'deskripsi_222405'   => 'Breathable sport t-shirt for high-intensity workouts.',
                'harga_222405'       => 199000,
                'id_kategori_222405' => $activewearCategory->id_kategori_222405,
                'path_img_222405'    => 'produk/tshirt_sport.jpg',
                'jumlah_222405'      => 95,
                'created_at_222405'  => Carbon::now()->toDateTimeString()
            ];
        }

        // Products for Accessories category
        $accessoriesCategory = $categories->where('nama_222405', 'Accessories')->first();
        if ($accessoriesCategory) {
            $products[] = [
                'id_produk_222405'   => Str::uuid()->toString(),
                'nama_222405'        => 'Beanie Hat',
                'deskripsi_222405'   => 'Warm knitted beanie hat for winter.',
                'harga_222405'       => 129000,
                'id_kategori_222405' => $accessoriesCategory->id_kategori_222405,
                'path_img_222405'    => 'produk/hat_beanie.jpg',
                'jumlah_222405'      => 100,
                'created_at_222405'  => Carbon::now()->toDateTimeString()
            ];

            $products[] = [
                'id_produk_222405'   => Str::uuid()->toString(),
                'nama_222405'        => 'Leather Belt',
                'deskripsi_222405'   => 'Classic leather belt that completes any outfit.',
                'harga_222405'       => 199000,
                'id_kategori_222405' => $accessoriesCategory->id_kategori_222405,
                'path_img_222405'    => 'produk/belt_leather.jpg',
                'jumlah_222405'      => 80,
                'created_at_222405'  => Carbon::now()->toDateTimeString()
            ];
        }

        // Create all products
        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
