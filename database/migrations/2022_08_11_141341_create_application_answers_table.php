<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationAnswersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('application_id')->unsigned();
            $table->integer('question_id')->unsigned();
            $table->string('answer_by_input')->nullable();
            $table->integer('question_answer_id')->unsigned();
            $table->integer('condition')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('application_id')->references('id')->on('applications');
            $table->foreign('question_id')->references('id')->on('questions');
            $table->foreign('question_answer_id')->references('id')->on('question_answers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('application_answers');
    }
}
