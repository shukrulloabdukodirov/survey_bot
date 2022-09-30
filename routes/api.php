<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Resources\QuestionResource;
use App\Models\User;
use Base\Resource\Domain\Models\EducationCenter;
use Base\Resource\Domain\Models\Speciality;
use Base\Survey\Application\Http\Controllers\Api\V1\QuestionAPIController;
use Base\Survey\Domain\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
Route::post('logout',function(Request $request){
    request()->user()->tokens()->delete();
    return ['success'=>true,'message'=>'Logged out!'];
});


Route::group(
    [
        'excluded_middleware' => ['auth:sanctum'],
    ],function(){
        Route::post('login',
           [LoginController::class,'login']
        );
        Route::get('v1/front/questions',[QuestionAPIController::class,'index']);
    }
);

