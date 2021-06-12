<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Roman Katin and Maxim Tsetserev (c) 2021
|
//*/

session_start();

Route::get('/',[ArticleController::class,'allArticles'])->name('home');
Route::get('/best',[ArticleController::class,'bestArticles'])->name('best');
Route::get('/tag/{tag}',[ArticleController::class,'tagArticles'])->name('tag');
Route::get('/page-error',[Controller::class,'notFound'])->name('errorPage');
Route::get('/article/{id}',[ArticleController::class,'oneArticle'])->name('article');
Route::get('/article/sortBy/{interval}',[ArticleController::class,'orderByTime'])->name('articleForTime');
Route::get('/user/settings',[UserController::class,'userSettingView'])->name('userSettings');
Route::get('/user/{id}',[UserController::class,'index'])->name('getUser');
Route::get('/user/{id}/{statistic_name}',[UserController::class,'getUserArticles'])->name('getUserArticles');




Route::get('/auth',function (){
   return view('auth.auth');
})->name('auth');




Route::group(['middleware' => 'isAuth'],function(){
    Route::post('/user/updateProfile',[UserController::class,'updateUser'])->name('updateUser');
    Route::get('/user/settings',[UserController::class,'userSettingView'])->name('userSettings');
    Route::get('/user/{id}',[UserController::class,'index'])->name('getUser');
    Route::get('/user/{id}/{statistic_name}',[UserController::class,'getUserArticles'])->name('getUserArticles');
    Route::get('/article/{id}',[ArticleController::class,'oneArticle'])->name('article');
    Route::post('/addFavorite',[ArticleController::class,'addFavorite'])->name('addFavorite');
    Route::post('/article/{id}/comment',[ArticleController::class,'sendComment'])->name('sendComment');
    Route::get('/add/article',function (){return view('newArticle');})->name('newArticleForm');
    Route::post('/add/article/insert',[ArticleController::class,'newArticle'])->name('newArticle');
    Route::group(['middleware' => 'isAdmin'],function(){
        Route::get('/admin',[AdminController::class,'index'])->name('admin');
        Route::get('/admin/article-page/{id}',[AdminController::class,'unModerArticlePage'])->name('articleUnModer');
        Route::get('/admin/accepted/{id}',[AdminController::class,'acceptArticle'])->name('accepted');
        Route::get('/admin/rejected/{id}',[AdminController::class,'rejectArticle'])->name('reject');
    });
});





Route::get('/logout',[AuthController::class,'dropSession'])->name('logout');





//Route::get('/user/{id}',[ArticleController::class,'oneArticle'])->name('user');
//Route::get('/{any}',function (){
//   return view('welcome');
//})->where('any',".*");


