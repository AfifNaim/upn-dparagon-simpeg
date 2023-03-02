<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Posisi 1',
                'salary' => '12000',

            ],
            [
                'name' => 'Posisi 2',
                'salary' => '11000',

            ],
            [
                'name' => 'Posisi 3',
                'salary' => '13000',

            ],
        ];

        foreach ($data as $key => $value) {
            Position::create($value);
        }
    }
}
