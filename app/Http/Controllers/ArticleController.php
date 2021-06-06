<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function allArticles()
    {
        $articles = Articles::orderBy('created_at','desc')->get();
        return view('welcome',compact('articles'));

    }

    public function oneArticle($id){
        $article = Articles::where('id', $id)->first();
        //$user = Articles::find(1)->user()->where('id',$id)->first();
        if($article){
            return view('article',compact('article'));
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
            'user_id' => '1',
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
}
