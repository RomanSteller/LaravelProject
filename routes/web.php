<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/',[ArticleController::class,'allArticles'])->name('home');

Route::get('log',[AuthController::class,'log'])->name('authInput');
Route::post('/auth/check', [AuthController::class,'authUser'])->name('auth');

Route::get('reg',[AuthController::class,'reg'])->name('regInput');
Route::post('/reg/check', [AuthController::class,'createUser'])->name('reg');

//Route::get('/{any}',function (){
//   return view('welcome');
//})->where('any',".*");


