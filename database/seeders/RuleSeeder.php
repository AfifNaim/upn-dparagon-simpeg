<?php

namespace Database\Seeders;

use App\Models\Rule;
use Illuminate\Database\Seeder;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rule = array(
            'time_in' => '08:00:00',
            'time_out' => '16:00:00',
            'total_yearly_leave' => '12',
            'total_big_leave' => '12',
            'total_mass_leave' => '12',
            'total_maternity_leave' => '12',
            'total_sick_leave' => '12',
            'total_yearly_leave' => '12',
            'total_important_leave' => '12',
            'monthly_leave_year_conditions' => '12',
            'big_month_leave_conditions' => '12',
        );

        Rule::create($rule);
    }
}
