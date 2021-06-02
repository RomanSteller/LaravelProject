<?php

use App\Http\Controllers\Api\v1\ArticleController;
use App\Http\Controllers\Api\v1\AuthController;
use Illuminate\Http\Request;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/create-user',[AuthController::class,'createUser'])->name('createuser');
Route::get('/get-articles',[ArticleController::class,'allArticles']);
Route::get('/get-articles-best',[ArticleController::class,'bestArticles']);
Route::get('/get-articles/{id}',[ArticleController::class,'oneArticle']);
Route::get('/get-articles-top',[ArticleController::class,'topArticles']);
