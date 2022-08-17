<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationCenterSpecialitiesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_center_specialities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('education_center_id')->unsigned();
            $table->integer('speciality_id')->unsigned();
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('education_center_id')->references('id')->on('education_centers');
            $table->foreign('speciality_id')->references('id')->on('specialities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('education_center_specialities');
    }
}
