<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->date('date');
            $table->integer('basic_salary')->unsigned()->nullable();
            $table->integer('allowance_amount')->unsigned()->nullable();
            $table->integer('pieces_amount')->unsigned()->nullable();
            $table->integer('salary_received_amount')->unsigned()->nullable();
            $table->date('date_sent')->nullable();
            $table->boolean('is_sent')->nullable()->default(false);
            $table->text('path');
            $table->timestamps();

            $table->index('employee_id');
            $table->foreign('employee_id')
                ->references('id')
                ->on('employees')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salaries');
    }
}
