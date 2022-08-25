<?php

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
Route::get('get-questions',function()
{
    $response=
    // Question::query()->get();
    QuestionResource::collection(Question::query()->get());
    // DB::table('questions')
    // ->select(['questions.*','question_translations.text as question'])
    // ->join('question_translations','question_translations.question_id','=','questions.id')
    // ->join('question_answer_translations','question_answer_translations.question_id','=','questions.id')
    // ->where('question_translations.locale','=','uz')
    // ->get();
    return $response;
});
