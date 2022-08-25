<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationCentersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_centers', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('status')->default(1);
            $table->integer('region_id')->unsigned()->nullable();
            $table->integer('city_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('region_id')->references('id')->on('regions');
            $table->foreign('city_id')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('education_centers');
    }
}
