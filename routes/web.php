<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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
session_start();

Route::get('/add/article',function (){return view('newArticle');});
Route::post('/add/article/insert',[ArticleController::class,'newArticle'])->name('newArticle');

Route::get('/',[ArticleController::class,'allArticles'])->name('home');
Route::get('/auth',function (){
   return view('auth.auth');
})->name('auth');
Route::get('/logout',[AuthController::class,'dropSession'])->name('logout');

Route::get('/article/{id}',[ArticleController::class,'oneArticle'])->name('article');


Route::get('/user/{id}',[UserController::class,'index'])->name('getUser');
//Route::get('/user/{id}',[ArticleController::class,'oneArticle'])->name('user');
//Route::get('/{any}',function (){
//   return view('welcome');
//})->where('any',".*");


