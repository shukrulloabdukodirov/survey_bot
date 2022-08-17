<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEducationCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('education_centers', function (Blueprint $table) {
            $table->integer('education_center_type_id')->unsigned()->nullable();
            $table->foreign('education_center_type_id')->references('id')->on('education_center_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('education_centers', function (Blueprint $table) {
            //
        });
    }
}
