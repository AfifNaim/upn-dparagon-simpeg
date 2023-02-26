<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerformanceAppraisalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performance_appraisals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->date('date');
            $table->integer('responsible');
            $table->integer('initiate');
            $table->integer('teamwork');
            $table->integer('discipline');
            $table->integer('work_performance');
            $table->integer('final_value');
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
        Schema::dropIfExists('performance_appraisals');
    }
}
