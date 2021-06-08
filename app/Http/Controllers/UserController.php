<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index($id){
        $user = User::find($id);
        $articlesChart = (new ArticleController)->articlesChart();
        return view('profile.profile',compact('user','articlesChart'));
    }

    public function getUserArticles($id,$statistic_name){
        if($statistic_name === 'articles') {
            $user = User::find($id);
            $articlesChart = (new ArticleController)->articlesChart();
            $articles = Articles::with('tags')->where('user_id', $id)->get();
            return view('profile.userInfo',compact('articles','user','articlesChart'));
        }
    }
}
