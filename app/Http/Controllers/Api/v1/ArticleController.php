<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Articles;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function allArticles(){
        $articles = Articles::all();

        if($articles){
            return response()->json([
                $articles
            ])->setStatusCode(201);
        }
    }

}
