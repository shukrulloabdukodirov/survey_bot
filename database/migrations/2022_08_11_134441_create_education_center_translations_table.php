<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationCenterTranslationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_center_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('locale');
            $table->integer('education_center_id')->unsigned();
            $table->softDeletes();
            $table->foreign('education_center_id')->references('id')->on('education_centers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('education_center_translations');
    }
}
