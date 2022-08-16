<?php

Route::resource('applications', V1\ApplicationAPIController::class);

Route::resource('application_answers', V1\ApplicationAnswerAPIController::class);
