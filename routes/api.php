<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Resources\QuestionResource;
use Base\Survey\Domain\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Authentication Routes...
// Route::get('login', [
//   'as' => 'login',
//   'uses' => 'Auth\LoginController@showLoginForm'
// ]);

Route::group(
    [
        'excluded_middleware' => ['auth:sanctum'],
    ],function(){
        Route::post('login',
           [LoginController::class,'login']
        );
        
    }
);
// Route::post('logout', [
//   'as' => 'logout',
//   'uses' => 'Auth\LoginController@logout'
// ]);

// // Password Reset Routes...
// Route::post('password/email', [
//   'as' => 'password.email',
//   'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail'
// ]);
// Route::get('password/reset', [
//   'as' => 'password.request',
//   'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm'
// ]);
// Route::post('password/reset', [
//   'as' => 'password.update',
//   'uses' => 'Auth\ResetPasswordController@reset'
// ]);
// Route::get('password/reset/{token}', [
//   'as' => 'password.reset',
//   'uses' => 'Auth\ResetPasswordController@showResetForm'
// ]);

// // Registration Routes...
// Route::get('register', [
//   'as' => 'register',
//   'uses' => 'Auth\RegisterController@showRegistrationForm'
// ]);
// Route::post('register',[RegisterController::class,'register']);
