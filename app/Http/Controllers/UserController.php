<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
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
            $articles = Articles::with('tags')->orderBy('created_at','desc')->where('user_id', $id)->where('status','Одобренно модерацией')->get();
            foreach ($articles as $article){
                (new ArticleController)->dateOutput($article);
            }
            return view('profile.userInfo', compact('articles', 'user', 'articlesChart', 'usersChart'));
        }elseif ($statistic_name === 'comments') {
            $comments = Comments::where('user_id', $id)->get();
            foreach ($comments as $comment) {
                (new ArticleController)->dateOutput($comment);
            }
            return view('profile.userInfo', compact('comments', 'user', 'articlesChart','usersChart'));
        }elseif($statistic_name === 'favorites'){
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

        $user = User::where('id', $_SESSION['user']['id'])->first();
        if (isset($request['name'])) {

            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:500'],
            ],$messages = [
                'name.required' => 'Поле имени не должно быть пустым',
                'name.string' => 'В имени не должно быть цифр и других знаков',
            ]);

            if ($validator->fails()) {
                return  back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $user->name = $request['name'];
            $user->save();

            return redirect()->route('userSettings')->with('updateName','Имя успешно обновленно');
        }

        if (isset($request['description'])) {

            $description = $request->validate([
                'description' => 'required|string'
            ]);



            $user = User::where('id', $_SESSION['user']['id'])->first();
            $user->description = $description['description'];
            $user->save();

            return redirect()->route('userSettings')->with('updateDescription','Описание успешно обновленно');
        }

        if (isset($request['email'])) {
            $validator = Validator::make($request->all(), [
                'email' => ['email'],
            ],$messages = [
                'email.email' => 'Почта должна быть валлидной'
            ]);

            if ($validator->fails()) {
                return  back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $user->email = $request['email'];
            $user->save();

            return redirect()->route('userSettings')->with('updateEmail','Почта успешно обновлена');
        }

        if (isset($request['password']) && isset($request['password_confirm']) && isset($request['old_password'])) {

            $userPassword = User::where('id',$_SESSION['user']['id'])->first();

            $validator = Validator::make($request->all(), [
                'password' => 'required|min:6',
                'password_confirm' => 'required|same:password',
                'old_password' => 'required'
            ],$messages = [
                'password.required' => 'Поле пароля не должно быть пусто',
                'password.min' => 'Пароль не должен содержать не менее 6 символов',
                'password_confirm.same' => 'Пароли должны совпадать',
                'password_confirm.required' => 'Поле повтора пароля не должно быть пусто',
                'old_password.required' => 'Поле старого пароля не должно быть пусто'
            ]);


            if ($validator->fails()) {
                return  back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if(!Hash::check($request['old_password'],$userPassword->password)){
                return back()
                    ->with('failOldPassword','Не правильно введен старый пароль');
            }else{
                $user->password = Hash::make($request['password']);
                $user->save();
            }




            return redirect()->route('userSettings')->with('updatePassword','Пароль успешно обновлен');

        }
    }


}
