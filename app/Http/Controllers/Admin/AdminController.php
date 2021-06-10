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
}
