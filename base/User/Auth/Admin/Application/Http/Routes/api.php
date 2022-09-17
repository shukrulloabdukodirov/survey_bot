<?php

use Base\User\Auth\Admin\Application\Http\Controllers\Api\V1\AccessAPIController;





//Route::get('users/access/roles', [V1\AccessAPIController::class, 'roles']);

Route::get('access/roles',[AccessAPIController::class, 'roles']);
Route::resource('users', V1\UserAPIController::class);
Route::resource('access', V1\AccessAPIController::class);
