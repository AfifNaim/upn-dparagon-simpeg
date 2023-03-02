<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Division;

class DivisionSeeder extends Seeder
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
                'name' => 'Divisi 1',
            ],
            [
                'name' => 'Divisi 2',
            ],

        ];

        foreach ($data as $key => $value) {
            Division::create($value);
        }
    }
}
