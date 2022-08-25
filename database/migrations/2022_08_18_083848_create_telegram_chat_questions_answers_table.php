<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelegramChatQuestionsAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telegram_chat_questions_answers', function (Blueprint $table) {
            $table->id();
            $table->integer('applicant_id')->unsigned();
            $table->foreign('applicant_id')->references('id')->on('applicants');
            $table->integer('telegram_chat_question_id')->unsigned();
            $table->foreign('telegram_chat_question_id')->references('id')->on('telegram_chat_questions');
            $table->boolean('condition')->default(false);
            $table->string('value');
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
        Schema::dropIfExists('telegram_chat_questions_answers');
    }
}
