<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeDeductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_deductions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('deduction_id');

            $table->index('deduction_id');
            $table->index('employee_id');

            $table->foreign('deduction_id')
                ->references('id')
                ->on('deductions')
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
        Schema::dropIfExists('employee_deductions');
    }
}
