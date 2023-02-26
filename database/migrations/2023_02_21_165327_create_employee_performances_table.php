<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeePerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_performances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('allowance_id');


            $table->index('allowance_id');
            $table->index('employee_id');

            $table->foreign('allowance_id')
                ->references('id')
                ->on('allowances')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('employee_id')
                ->references('id')
                ->on('employees')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_performances');
    }
}
