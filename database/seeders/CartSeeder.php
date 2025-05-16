<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all users with customer role
        $customers = User::where('role_222405', 'customer')->get();

        // Create cart for each customer
        foreach ($customers as $customer) {
            Cart::create([
                'id_cart_222405' => Str::uuid()->toString(),
                'id_user_222405' => $customer->id_user_222405
            ]);
        }
    }
}
