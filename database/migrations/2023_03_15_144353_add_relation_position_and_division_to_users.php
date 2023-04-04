<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationPositionAndDivisionToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->unsignedBigInteger('position_id')->nullable();
            $table->unsignedBigInteger('division_id')->nullable();

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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('position_id','division_id');
        });
    }
}
