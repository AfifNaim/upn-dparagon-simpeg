<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'ini akun Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'Admin'
            ],
            [
                'name' => 'ini akun Hrd',
                'email' => 'hrd@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'HRD'
            ],
            [
                'name' => 'ini akun Staff',
                'email' => 'staff@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'Staff'
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
