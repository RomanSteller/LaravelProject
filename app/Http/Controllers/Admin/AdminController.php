<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Controller;
use App\Models\Articles;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $articleModel = new Articles();
        $articlesChart = (new ArticleController())->articlesChart();

        $articles = $articleModel->UnModeratedArticles();
        return view('admin.admin-panel',compact('articlesChart','articles'));
    }

    public function unModerArticlePage($id){
        $articlesChart = (new ArticleController())->articlesChart();
        $article = Articles::where('id',$id)->where('status','Находится на модерации')->first();
        return view('admin.unmoderArticle-page',compact('article','articlesChart'));
    }

    public function acceptArticle($id)
    {
        $article = Articles::where('id',$id)->first();
        $article['status'] = 'Одобрено модерацией';
        $article->save();
        return redirect()->route('admin');
    }

    public function rejectArticle($id){
        $article = Articles::where('id',$id)->first();
        $article['status'] = 'Пост отклонён';
        $article->save();
        return redirect()->route('admin');
    }
}
