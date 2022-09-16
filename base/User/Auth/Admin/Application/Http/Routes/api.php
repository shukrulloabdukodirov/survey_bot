<?php






Route::resource('users', V1\UserAPIController::class);
Route::resource('access', V1\AccessAPIController::class);
Route::get('access/roles', [V1\AccessAPIController::class, 'roles']);
