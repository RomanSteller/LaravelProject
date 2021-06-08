<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;

    public function articles(){
        return $this->belongsToMany(Articles::class, 'articles_tags', 'tag_id', 'article_id');
    }

    public function comments(){
        return $this->hasMany(Comments::class);
    }

    protected $fillable = [

    ];
}
