<?php
Route::resource('surveys', V1\SurveyAPIController::class);


Route::resource('survey_translations', V1\SurveyTranslationAPIController::class);




Route::resource('question_translations', V1\QuestionTranslationAPIController::class);


Route::resource('question_answers', V1\QuestionAnswerAPIController::class);






Route::resource('questions', V1\QuestionAPIController::class);


Route::resource('question_answer_translations', V1\QuestionAnswerTranslationAPIController::class);
