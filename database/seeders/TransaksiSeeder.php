<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all customers and products
        $customers = User::where('role_222405', 'customer')->get();
        $products  = Product::all();

        // Create transaction statuses array
        $statuses = ['pending', 'dikemas', 'dikirim', 'selesai'];

        // Create 20 random transactions
        for ($i = 0; $i < 20; $i++) {
            // Get random customer and product
            $customer = $customers->random();
            $product  = $products->random();

            // Generate random date within the last 30 days
            $date = Carbon::now()->subDays(rand(0, 30))->toDateTimeString();

            // Random quantity between 1 and 3
            $quantity = rand(1, 3);

            // Calculate total price
            $totalPrice = $product->harga_222405 * $quantity;

            // Random status
            $status = $statuses[rand(0, 3)];

            // Evidence of transfer (only for paid, shipped, and delivered statuses)
            $buktiTf = null;
            if (in_array($status, ['pending', 'dikemas', 'dikirim', 'selesai'])) {
                $buktiTf = 'bukti_tf/transfer_' . ($i + 1) . '.jpg';
            }

            Transaksi::create([
                'id_transaksi_222405'      => Str::uuid()->toString(),
                'id_user_222405'           => $customer->id_user_222405,
                'jumlah_222405'            => $quantity,
                'id_produk_222405'         => $product->id_produk_222405,
                'harga_total_222405'       => $totalPrice,
                'status_222405'            => $status,
                'bukti_tf_222405'          => $buktiTf,
                'tanggal_transaksi_222405' => $date
            ]);
        }
    }
}
