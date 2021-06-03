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
}
