<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;

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
                'employee_id' => $this->employeeId(),
                'name' => 'ini akun Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'Admin',
            ],
            [
                'employee_id' => $this->employeeId(),
                'name' => 'ini akun Hrd',
                'email' => 'hrd@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'HRD',
            ],
            [
                'employee_id' => $this->employeeId(),
                'name' => 'ini akun Staff',
                'email' => 'staff@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'Staff',  
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }

    function employeeId()
    {
        do {
            $code = random_int(10000000, 99999999);
        } while (User::where("employee_id", "=", $code)->first());
  
        return $code;
    }
}
