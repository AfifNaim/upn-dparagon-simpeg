<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rules', function (Blueprint $table) {
            $table->id();
            $table->time('time_in')->nullable();
            $table->time('time_out')->nullable();
            $table->integer('total_yearly_leave')->unsigned()->nullable()->default(12);
            $table->integer('total_big_leave')->unsigned()->nullable()->default(12);
            $table->integer('total_mass_leave')->unsigned()->nullable()->default(12);
            $table->integer('total_maternity_leave')->unsigned()->nullable()->default(12);
            $table->integer('total_sick_leave')->unsigned()->nullable()->default(12);
            $table->integer('total_important_leave')->unsigned()->nullable()->default(12);
            $table->integer('monthly_leave_year_conditions')->unsigned()->nullable()->default(0);
            $table->integer('big_month_leave_conditions')->unsigned()->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rules');
    }
}
