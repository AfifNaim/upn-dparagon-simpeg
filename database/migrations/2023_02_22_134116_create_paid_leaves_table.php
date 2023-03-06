<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaidLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paid_leaves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->enum('type', ['Yearly', 'Big', 'Mass', 'Maternity', 'Sick', 'Important']);
            $table->date('date_send');
            $table->date('date_start');
            $table->date('date_end');
            $table->text('description');
            $table->enum('status', ['Disetujui HRD', 'Ditolak HRD', 'Diterima Manager', 'Ditolak Manager', 'Dalam Proses']);
            $table->date('date_accept_manager')->nullable();
            $table->date('date_accept_hrd')->nullable();
            $table->date('date_decline_manager')->nullable();
            $table->date('date_decline_hrd')->nullable();
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
        Schema::dropIfExists('paid_leaves');
    }
}
