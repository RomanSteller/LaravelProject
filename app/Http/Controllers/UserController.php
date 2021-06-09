<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        if($request['description']){
            $user = User::where('id',$_SESSION['user']['id'])->first();
            $user['description'] = $request['description'];
            $user->save();
        }

        if($request['email']){
            $user = User::where('id',$_SESSION['user']['id'])->first();
            $user['email'] = $request['email'];
            $user->save();
            return redirect()->route('userSettings');
        }

        if($request['password'] && $request['password-confirm']){
           $errors =  $request->validate([
                'password' => 'required|min:9',
                'password-confirm' => 'required|same:password',
            ]);

            if ($errors ->fails()) {
                return redirect(route('userSettings'))
                    ->withErrors($errors)
                    ->withInput();
            }

            $user = User::where('id',$_SESSION['user']['id'])->first();
            $user['password'] = Hash::make($request['password']);
            $user->save();
            return redirect()->route('userSettings');
        }




    }
}
