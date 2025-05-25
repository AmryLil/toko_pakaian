<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create admin user
        User::create([
            'email_222405'         => 'admin123@gmail.com',
            'name_222405'          => 'Admin User',
            'password_222405'      => Hash::make('admin123'),
            'role_222405'          => 'admin',
            'gender_222405'        => 'male',
            'address_222405'       => 'Jl. Admin No. 1, Jakarta',
            'phone_222405'         => '081234567890',
            'birth_date_222405'    => '1990-01-01',
            'profile_photo_222405' => 'profile/admin.jpg'
        ]);
    }
}
