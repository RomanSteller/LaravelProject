<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function allArticles()
    {
        $articles = Articles::all();
        return view('welcome',compact('articles'));

    }

    public function oneArticle($id){
        $article = Articles::where('id', $id)->first();
        //$user = Articles::find(1)->user()->where('id',$id)->first();
        if($article){
            return view('article',compact('article'));
        }else if(empty($article)){
            return response()->json([
                'message'=>'Данная статья отсутствует'
            ])->setStatusCode(404);
        }
    }
}
