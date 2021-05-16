<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_status')->nullable();

            // foreign
            $table->integer('account_id')->unsigned();
            $table->foreign('account_id')
            ->references('id')
            ->on('accounts')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            // foreign
            $table->integer('service_category_id')->unsigned();
            $table->foreign('service_category_id')
            ->references('id')
            ->on('service_categories')
            ->onDelete('cascade')
            ->onUpdate('cascade');

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
        Schema::dropIfExists('subscription_accounts');
    }
}
