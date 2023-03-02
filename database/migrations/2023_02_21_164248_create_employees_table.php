<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->string('name');
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->string('religion');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('address');
            $table->string('residence_address');
            $table->enum('status', ['Lajang', 'Kawin']);
            $table->integer('child');
            $table->string('phone');
            $table->date('date_in');
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->unsignedBigInteger('position_id')->nullable();
            $table->unsignedBigInteger('division_id')->nullable();
            $table->string('path');
            $table->timestamps();
            $table->softDeletes();

            $table->index('position_id');
            $table->index('division_id');
            $table->foreign('position_id')
                ->references('id')
                ->on('positions')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->foreign('division_id')
                ->references('id')
                ->on('divisions')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->foreign('manager_id')
                ->references('id')
                ->on('employees')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
