<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimcardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simcards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sim_name');
            $table->string('sim_number');
            $table->string('sim_description')->nullable();
            $table->string('sim_status');

            // foreign
            $table->integer('sim_network_id')->unsigned();
            $table->foreign('sim_network_id')
            ->references('id')
            ->on('sim_net_works')
            ->onDelete('cascade')
            ->onUpdate('cascade');

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
        Schema::dropIfExists('simcards');
    }
}
