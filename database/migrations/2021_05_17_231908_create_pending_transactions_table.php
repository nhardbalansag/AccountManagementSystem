<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendingTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pending_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');

            // foreign
            $table->integer('transaction_details_id')->unsigned();
            $table->foreign('transaction_details_id')
            ->references('id')
            ->on('transaction_details')
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
        Schema::dropIfExists('pending_transactions');
    }
}
