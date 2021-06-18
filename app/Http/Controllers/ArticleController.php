<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Comments;
use App\Models\Favorites;
use App\Models\Tags;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

date_default_timezone_set('Europe/Moscow');

class ArticleController extends Controller
{

    public function dateOutputDay($article){
        switch($article->created_at->format('w')){
            case 1:
                $created_time_day = 'Понедельник';
                return $created_time_day;
                break;
            case 2:
                $created_time_day = 'Вторник';
                return $created_time_day;
                break;
            case 3:
                $created_time_day = 'Среда';
                return $created_time_day;
                break;
            case 4:
                $created_time_day = 'Четверг';
                return $created_time_day;
                break;
            case 5:
                $created_time_day = 'Пятница';
                return $created_time_day;
                break;
            case 6:
                $created_time_day = 'Суббота';
                return $created_time_day;
                break;
            case 7:
                $created_time_day = 'Воскресенье';
                return $created_time_day;
                break;
        }

    }
    public function dateOutputMounth($article){
        switch($article['created_at']->format('m')){
            case 1:
                $created_time_month = 'Января';
                return $created_time_month;
                break;
            case 2:
                $created_time_month = 'Февраля';
                return $created_time_month;
                break;
            case 3:
                $created_time_month = 'Марта';
                return $created_time_month;
                break;
            case 4:
                $created_time_month = 'Апреля';
                return $created_time_month;
                break;
            case 5:
                $created_time_month = 'Мая';
                 return $created_time_month;
                break;
            case 6:
                $created_time_month = 'Июня';
                 return $created_time_month;
                break;
            case 7:
                $created_time_month = 'Июля';
                 return $created_time_month;
                break;
            case 8:
                $created_time_month = 'Августа';
                 return $created_time_month;
                break;
            case 9:
                $created_time_month = 'Сентября';
                 return $created_time_month;
                break;
            case 10:
                $created_time_month = 'Октября';
                 return $created_time_month;
                break;
            case 11:
                $created_time_month = 'Ноября';
                 return $created_time_month;
                break;
            case 12:
                $created_time_month = 'Декабря';
                return $created_time_month;
                break;
        }

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

    private static function dateFormat($article)
    {
        $article['created_time'] = $article['created_at']->format('y.m.d');
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



    public function orderByTime($interval){
        date_default_timezone_set('Europe/Moscow');

        $yearStart = (new \Carbon\Carbon)->startOfYear()->format('y.m.d');
        $usersChart = ArticleController::usersChart();
        $articles = Articles::orderBy('created_at','desc')->where('status','Одобрено модерацией')->get();
        $curDate = date('y.m.d');
        $articlesChart = ArticleController::articlesChart();
        foreach ($articles as $article){
            ArticleController::dateFormat($article);
        }

        if($interval === 'today'){
            $articles = $articles->where('created_time',$curDate);
            return view('welcome',compact('articles', 'articlesChart','usersChart'));

        }else if($interval === 'oneWeak') {
            $articles = $articles->whereBetween('created_time',[date('d')-7,$curDate]);
            return view('welcome',compact('articles', 'articlesChart','usersChart'));
        }else if($interval === 'forYear'){
            $articles = $articles->whereBetween('created_time',[$yearStart,$curDate]);
            return view('welcome',compact('articles', 'articlesChart','usersChart'));
        }

//        $article['created_at']->

    }

    public function bestArticles(){
        $articles = Articles::orderBy('save_count','desc')->get();
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

        $tags = Tags::all();
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

        $articleId = session('articleId');
        if(is_null($articleId)){
            $article = Articles::create([
                'user_id' => $_SESSION['user']['id'],
                'name' => $request['caption'],
                'content' => $a
            ]);
            session(['articleId' => $article->id]);
        }else{
            $article = Articles::find($articleId);
        }
//        session()->forget('articleId');
        return view('newArticleSetTags',compact('article','tags'));

//        if($articles){
//            return redirect()->route('home')->with('successArticle','Пост отправлен на модерацию');
//        }
        //$article = Articles::where('id', $id)->first();
        //if($article){
            //return view('article',compact('article'));
       // }
    }

    public function setTags(Request $request){
        dd($request['tags']);
//        $articleId = session('articleId');
//        $article = Articles::find($articleId);
//        $article->tags()->attach($request['tagId']);
//        return redirect()->back()->withInput();
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
             Favorites::create([
                'article_id' => $article_id,
                'user_id' => $user_id
            ]);
            Articles::where('id',$article_id)->increment('save_count');
        }
    }
}
