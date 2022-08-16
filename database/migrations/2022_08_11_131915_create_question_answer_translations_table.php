<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionAnswerTranslationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_answer_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->text('string')->nullable();
            $table->string('locale');
            $table->integer('question_answer_id')->unsigned();
            $table->softDeletes();
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
        Schema::drop('question_answer_translations');
    }
}
