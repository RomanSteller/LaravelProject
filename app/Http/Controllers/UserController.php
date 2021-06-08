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

    public function userSettingView(){
        $user = User::where('id',$_SESSION['user']['id'])->first();
        $articlesChart = (new ArticleController())->articlesChart();
        return view('profile.updateUser',compact('user','articlesChart'));
    }

    public function updateUser(Request $request){
        if($request['name']){
            $user = User::where('id',$_SESSION['user']['id'])->first();
            $user['name'] = $request['name'];
            $user->save();
            return redirect()->route('userSettings');

        }
    }
}
