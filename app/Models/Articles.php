<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    use HasFactory;

    public function tags(){
        return $this->belongsToMany(Tags::class, 'articles_tags', 'article_id', 'tag_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function comments(){
        return $this->hasMany(Comments::class,'article_id');
    }

    public function UnModeratedArticles(){
        return Articles::where('status','Находится на модерации')->get();
    }

    protected $fillable = [
        'user_id',
        'name',
        'status',
        'save_count',
        'content',
        'views_count'
    ];
}
