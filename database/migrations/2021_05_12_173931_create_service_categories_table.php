<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('service_category_name');
            $table->string('service_category_description')->nullable();
            $table->string('service_category_status')->nullable();

            // foreign
            $table->integer('social_media_platform_id')->unsigned();
            $table->foreign('social_media_platform_id')
            ->references('id')
            ->on('social_media_platforms')
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
        Schema::dropIfExists('service_categories');
    }
}
