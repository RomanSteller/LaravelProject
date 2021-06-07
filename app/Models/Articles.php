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

    protected $fillable = [
        'user_id',
        'name',
        'status',
        'save_count',
        'content'
    ];
}
