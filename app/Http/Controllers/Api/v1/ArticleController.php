<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Articles;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function allArticles(){
        $articles = Articles::all();
//        $articles = Articles::all()->user()->get();
//        $user = Articles::find(1)->user()->get();



        if($articles){
            return response()->json([
                $articles
            ])->setStatusCode(201);
        }
    }


    public function bestArticles(){
        $articles = Articles::orderBy('save_count','desc')->get();// Надо добавить сортировку по времени(за сегодня, неделю, месяц)
        if($articles){
            return response()->json([
                $articles
            ])->setStatusCode(201);
        }
    }


    public function oneArticle($id){
        $articles = Articles::where('id', $id)->first();
        $user = Articles::find(1)->user()->where('id',$id)->first();
        if($articles){
            return response()->json([
                $articles,
                $user
            ])->setStatusCode(201);
        }else if(empty($articles)){
            return response()->json([
                'message'=>'Данная статья отсутствует'
            ])->setStatusCode(404);
        }
    }


    public function topArticles(){
        $articles = Articles::select('id','name','save_count')->orderBy('save_count','desc')->get();// Надо добавить сортировку по времени(только за этот месяц)
        if($articles){
            return response()->json([
                $articles
            ])->setStatusCode(201);
        }
    }


}
