<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status')->nullable();

            // foreign
            $table->integer('emailid')->unsigned();
            $table->foreign('emailid')
            ->references('id')
            ->on('emails')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            // foreign
            $table->integer('simcardid')->unsigned();
            $table->foreign('simcardid')
            ->references('id')
            ->on('simcards')
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
        Schema::dropIfExists('accounts');
    }
}
