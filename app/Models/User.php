<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    public function article(){
        return $this->hasMany(Articles::class);
    }

    public function favorites(){
        return $this->hasMany(Favorites::class);
    }

    public function comments(){
        return $this->hasMany(Comments::class);
    }

    public function isAuth(){
        if(isset($_SESSION['user'])){
            return true;
        }
    }

    public function isAdmin(){
        if(isset($_SESSION['user'])){
            if($_SESSION['user']['role'] === 'admin'){
                return true;
            }
        }
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'login',
        'role',
        'photo',
        'description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
