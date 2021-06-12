<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Comments;
use App\Models\Favorites;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function dateOutputDay($article){
        switch($article->created_at->format('w')){
            case 1:
                $created_time_day = 'Понедельник';
                break;
            case 2:
                $created_time_day = 'Вторник';
                break;
            case 3:
                $created_time_day = 'Среда';
                break;
            case 4:
                $created_time_day = 'Четверг';
                break;
            case 5:
                $created_time_day = 'Пятница';
                break;
            case 6:
                $created_time_day = 'Суббота';
                break;
            case 7:
                $created_time_day = 'Воскресенье';
                break;
        }
        return $created_time_day;
    }
    public function dateOutputMounth($article){
        switch($article['created_at']->format('m')){
            case 1:
                $created_time_month = 'Января';
                break;
            case 2:
                $created_time_month = 'Февраля';
                break;
            case 3:
                $created_time_month = 'Марта';
                break;
            case 4:
                $created_time_month = 'Апреля';
                break;
            case 5:
                $created_time_month = 'Мая';
                break;
            case 6:
                $created_time_month = 'Июня';
                break;
            case 7:
                $created_time_month = 'Июля';
                break;
            case 8:
                $created_time_month = 'Августа';
                break;
            case 9:
                $created_time_month = 'Сентября';
                break;
            case 10:
                $created_time_month = 'Октября';
                break;
            case 11:
                $created_time_month = 'Ноября';
                break;
            case 12:
                $created_time_month = 'Декабря';
                break;
        }
        return $created_time_month;
    }


    public function dateOutput($article)
    {
            if ($article['created_at']->format('d') > date('d')-1 && $article['created_at']->format('m Y')==date('m Y'))
                $article['created_time'] = $article['created_at']->diffForHumans();
            elseif ($article['created_at']->format('d')==date('d')-1 && $article['created_at']->format('m Y')==date('m Y'))
                $article['created_time'] = 'вчера, в '.$article['created_at']->format('H:i');
            elseif($article['created_at']->format('d')<date('d')-1 && $article['created_at']->format('m Y')==date('m Y')){
                $created_time_day = ArticleController::dateOutputDay($article);
                $article['created_time'] = $created_time_day.', в '.$article['created_at']->format('H:i');
            }
            elseif($article['created_at']->format('m')<date('m') && $article['created_at']->format('y')==date('y')){
                $created_time_month = ArticleController::dateOutputMounth($article);
                $created_time_day = ArticleController::dateOutputDay($article);
                $article['created_time'] = $article['created_at']->format('j').' '.$created_time_month.' '.', в '.$article['created_at']->format('H:i');
            }
            elseif($article['created_at']->format('y')<date('y')){
                $created_time_month = ArticleController::dateOutputMounth($article);
                $created_time_day = ArticleController::dateOutputDay($article);
                $article['created_time'] = $article['created_at']->format('j').' '.$created_time_month.$article['created_at']->format(' Y').' в '.$article['created_at']->format('H:i');
            }
        return $article;
    }

    public function articlesChart(){
        $articlesChart = Articles::orderBy('save_count','desc')->where('status','Одобрено модерацией')->whereDate('created_at', '>=', Carbon::now()->startOfMonth())->limit(5)->get();
        return $articlesChart;
    }
    public function usersChart(){
        $usersChart = User::all();
        $articlesList = Articles::all();
        foreach ($usersChart as $user){
            foreach ($articlesList as $article){
                if ($article['user_id'] == $user['id']){
                    $user['save_count'] = $user['save_count'] + $article['save_count'];
                }
            }
        }
        //$usersChart = $usersChart->sortByDesc('save_count');
        //dd($usersChart);
        $usersChart = $usersChart->slice(0,5)->sortByDesc('save_count');

        //dd($usersChart,$articlesList);
        return $usersChart;
    }

    public function allArticles()
    {
        $articles = Articles::orderBy('created_at','desc')->where('status','Одобрено модерацией')->get();
        foreach ($articles as $article){
            ArticleController::dateOutput($article);
        }
        $articlesChart = ArticleController::articlesChart();
        $usersChart = ArticleController::usersChart();
        if($articles)
        return view('welcome',compact('articles', 'articlesChart','usersChart'));
    }

    public function bestArticles(){
        $articles = Articles::orderBy('save_count','desc')->get();// Надо добавить сортировку по времени(за сегодня, неделю, месяц)
        foreach ($articles as $article){
            ArticleController::dateOutput($article);
        }
        $articlesChart = ArticleController::articlesChart();
        $usersChart = ArticleController::usersChart();
        if($articles)
            return view('welcome',compact('articles', 'articlesChart','usersChart'));
    }

    public function tagArticles($tag){
        $articles = Articles::all();// Надо добавить сортировку по времени(за сегодня, неделю, месяц)месяц
        foreach ($articles as $article){
            ArticleController::dateOutput($article);
        }
        $articlesChart = ArticleController::articlesChart();
        $usersChart = ArticleController::usersChart();
        if($articles)
            return view('welcome',compact('articles', 'articlesChart','usersChart'));
    }

    public function oneArticle($id){
        $article = Articles::where('id', $id)->first();
        $this->updateViews($id);
        ArticleController::dateOutput($article);
        $comments = Comments::where('article_id',$id)->orderBy('created_at','desc')->get();
        foreach ($comments as $comment){
            $this->dateOutput($comment);
        }

        $articlesChart = ArticleController::articlesChart();
        $usersChart = ArticleController::usersChart();
//        $comments = Comments::where('article_id',$id)->get();
//        ArticleController::dateOutput($comments);


        if($article){
            return view('article',compact('article', 'articlesChart','comments','usersChart'));
        }else if(empty($article)){
            return response()->json([
                'message'=>'Данная статья отсутствует'
            ])->setStatusCode(404);
        }
    }

    public function newArticle(Request $request){
        $a = '';
        $requestKeys = collect($request->all())->keys();
        $caption = $request['caption'];
        for ($i = 0; $i < 6; $i ++){
            if($request[$i.'text']){
                $a = $a.'<p>'.$request[$i.'text'].'</p>';
            }
            else if($request[$i.'img']){
                $file = $request[$i.'img'];
                $upload_folder = '/public/articles_content';
                $filename = $file->getClientOriginalName();
                $new_filename = time().'_'.$filename;
                Storage::putFileAs($upload_folder, $file, $new_filename);
                //$a = $a.'<img src="'.$request[$i.'img'].'" alt="">';
                //$request->file($i.'img')->move(storage_path('images'), time().'_'.$request->file($i.'img')->getClientOriginalName());
                //$file_path = $request->file($i.'img')->store('/storage/articles_content');
                $a = $a.'<img src="/storage/articles_content/'.$new_filename.'" alt="">';
            }
        }
        $articles = Articles::create([
            'user_id' => $_SESSION['user']['id'],
            'name' => $request['caption'],
            'content' => $a
        ]);

        return response()->json([
            'message'=>$requestKeys.' '.$a
        ]);
        //$article = Articles::where('id', $id)->first();
        //if($article){
            //return view('article',compact('article'));
       // }
    }

    public function sendComment(Request $request,$id){



         Comments::create([
            'user_id' => $_SESSION['user']['id'],
            'article_id' => $id,
            'comments' => $request['comments'],
        ]);

        return redirect(route('article',['id'=>$id]));

    }

    public function updateViews($id){
        Articles::where('id',$id)->increment('views_count');
    }

    public function addFavorite(Request $request){
        $user_id = $_SESSION['user']['id'];
        $article_id = $request['article_id'];

        if (Favorites::where([['user_id', $user_id],['article_id',$article_id]])->exists()){
            Favorites::where([['user_id', $user_id],['article_id',$article_id]])->delete();
            Articles::where('id',$article_id)->decrement('save_count');
        }else{
            $user = Favorites::create([
                'article_id' => $article_id,
                'user_id' => $user_id
            ]);
            Articles::where('id',$article_id)->increment('save_count');
        }
    }
}
