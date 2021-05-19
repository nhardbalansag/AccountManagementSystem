<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transaction_details_number');
            $table->string('payment_status')->nullable();
            $table->string('payment_type');
            $table->integer('client_boost_number_target');
            $table->decimal('total_price', 14, 2);

            // foreign
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')
            ->references('id')
            ->on('clients')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            // foreign
            $table->integer('price_information_id')->unsigned();
            $table->foreign('price_information_id')
            ->references('id')
            ->on('price_information')
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
        Schema::dropIfExists('transaction_details');
    }
}
