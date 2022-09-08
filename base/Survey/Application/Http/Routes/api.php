<?php
Route::resource('surveys', V1\SurveyAPIController::class);

Route::resource('question_answers', V1\QuestionAnswerAPIController::class);

Route::resource('questions', V1\QuestionAPIController::class);
