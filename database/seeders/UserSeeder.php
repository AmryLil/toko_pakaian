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
            'id_user_222405'       => Str::uuid()->toString(),
            'email_222405'         => 'admin@fashionstore.com',
            'name_222405'          => 'Admin User',
            'password_222405'      => Hash::make('admin123'),
            'role_222405'          => 'admin',
            'gender_222405'        => 'male',
            'address_222405'       => 'Jl. Admin No. 1, Jakarta',
            'phone_222405'         => '081234567890',
            'birth_date_222405'    => '1990-01-01',
            'profile_photo_222405' => 'profile/admin.jpg'
        ]);

        // Create regular users
        $users = [
            [
                'id_user_222405'       => Str::uuid()->toString(),
                'email_222405'         => 'budi@gmail.com',
                'name_222405'          => 'Budi Santoso',
                'password_222405'      => Hash::make('password123'),
                'role_222405'          => 'customer',
                'gender_222405'        => 'male',
                'address_222405'       => 'Jl. Merdeka No. 123, Bandung',
                'phone_222405'         => '085678901234',
                'birth_date_222405'    => '1995-05-15',
                'profile_photo_222405' => 'profile/budi.jpg'
            ],
            [
                'id_user_222405'       => Str::uuid()->toString(),
                'email_222405'         => 'ani@gmail.com',
                'name_222405'          => 'Ani Wijaya',
                'password_222405'      => Hash::make('password123'),
                'role_222405'          => 'customer',
                'gender_222405'        => 'female',
                'address_222405'       => 'Jl. Sudirman No. 45, Jakarta',
                'phone_222405'         => '087890123456',
                'birth_date_222405'    => '1992-09-23',
                'profile_photo_222405' => 'profile/ani.jpg'
            ],
            [
                'id_user_222405'       => Str::uuid()->toString(),
                'email_222405'         => 'deni@gmail.com',
                'name_222405'          => 'Deni Pratama',
                'password_222405'      => Hash::make('password123'),
                'role_222405'          => 'customer',
                'gender_222405'        => 'male',
                'address_222405'       => 'Jl. Gatot Subroto No. 78, Surabaya',
                'phone_222405'         => '089012345678',
                'birth_date_222405'    => '1988-12-10',
                'profile_photo_222405' => 'profile/deni.jpg'
            ],
            [
                'id_user_222405'       => Str::uuid()->toString(),
                'email_222405'         => 'siti@gmail.com',
                'name_222405'          => 'Siti Rahayu',
                'password_222405'      => Hash::make('password123'),
                'role_222405'          => 'customer',
                'gender_222405'        => 'female',
                'address_222405'       => 'Jl. Ahmad Yani No. 32, Yogyakarta',
                'phone_222405'         => '083456789012',
                'birth_date_222405'    => '1997-03-28',
                'profile_photo_222405' => 'profile/siti.jpg'
            ],
            [
                'id_user_222405'       => Str::uuid()->toString(),
                'email_222405'         => 'rudi@gmail.com',
                'name_222405'          => 'Rudi Hartono',
                'password_222405'      => Hash::make('password123'),
                'role_222405'          => 'customer',
                'gender_222405'        => 'male',
                'address_222405'       => 'Jl. Diponegoro No. 56, Semarang',
                'phone_222405'         => '082345678901',
                'birth_date_222405'    => '1993-07-17',
                'profile_photo_222405' => 'profile/rudi.jpg'
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
