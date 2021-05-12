<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('client_email')->nullable();
            $table->string('client_phone_number')->nullable();
            $table->string('client_name');
            $table->string('client_social_media_account_name');
            $table->string('client_social_media_link');
            $table->string('client_boost_number_target');

            // foreign
            $table->integer('service_category_id')->unsigned();
            $table->foreign('service_category_id')
            ->references('id')
            ->on('service_categories')
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
        Schema::dropIfExists('clients');
    }
}
