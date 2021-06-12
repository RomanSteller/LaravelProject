<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Comments;
use App\Models\Favorites;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index($id)
    {
        $user = User::find($id);
        $articlesChart = (new ArticleController)->articlesChart();
        $usersChart = (new ArticleController)->usersChart();
        return view('profile.profile', compact('user', 'articlesChart', 'usersChart'));
    }

    public function getUserArticles($id, $statistic_name)
    {
        $user = User::find($id);
        $articlesChart = (new ArticleController)->articlesChart();
        $usersChart = (new ArticleController)->usersChart();

        if ($statistic_name === 'articles') {
            $articles = Articles::with('tags')->where('user_id', $id)->get();
            return view('profile.userInfo', compact('articles', 'user', 'articlesChart', 'usersChart'));
        }

        if ($statistic_name === 'comments') {
            $comments = Comments::where('user_id', $id)->get();
            foreach ($comments as $comment) {
                (new ArticleController)->dateOutput($comment);
            }
            return view('profile.userInfo', compact('comments', 'user', 'articlesChart','usersChart'));
        }

        if($statistic_name === 'favorites'){
            $favorites = Favorites::where('user_id',$id)->get();
            return view('profile.userInfo', compact('favorites', 'user', 'articlesChart','usersChart'));
        }



    }

    public function userSettingView()
    {
        $usersChart = (new ArticleController)->usersChart();
        $user = User::where('id', $_SESSION['user']['id'])->first();
        $articlesChart = (new ArticleController())->articlesChart();
        return view('profile.updateUser', compact('user', 'articlesChart','usersChart'));
    }

    public function updateUser(Request $request)
    {

        if (isset($request['name'])) {
            $user = User::where('id', $_SESSION['user']['id'])->first();
            $user->name = $request['name'];
            $user->save();

            return redirect(route('userSettings'));
        }

        if (isset($request['description'])) {

            $description = $request->validate([
                'description' => 'required|string'
            ]);

            $user = User::where('id', $_SESSION['user']['id'])->first();
            $user->description = $description['description'];
            $user->save();

            return redirect(route('userSettings'));
        }

        if (isset($request['email'])) {

            $user = User::where('id', $_SESSION['user']['id'])->first();
            $user->email = $request['email'];
            $user->save();

            return redirect(route('userSettings'));
        }

        if (isset($request['password']) && isset($request['password_confirm'])) {

            $request->validate([
                'password' => 'required|min:9',
                'password_confirm' => 'required|same:password',
            ]);

            $user = User::where('id', $_SESSION['user']['id'])->first();
            $user->password = Hash::make($request['password']);
            $user->save();

            return redirect(route('userSettings'));
        }
    }


}
