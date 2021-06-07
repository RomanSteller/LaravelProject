<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use http\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function createUser(CreateUserRequest $request){

        $user = User::create([
            'login' => $request['login'],
            'name' => $request['name'],
            'password' => Hash::make($request['password']),
            'email' => $request['email']
        ]);

        if($user){
            return response()->json([
                $user,
                "message" => "Пользователь успешно зарегестрирован"
            ])->setStatusCode(201);
        }
    }

    public function authUser(AuthRequest $request){
        $login = $request['login'];
        $user = User::where('login',$login)->first();

        if(!$user || !Hash::check($request['password'],$user['password'])){
            return response()->json([
                "message" => "Пользователь не найден"
            ])->setStatusCode(401);
        }else{
            $_SESSION['user'] = $user;
            $id = $_SESSION['user']['name'];
            return response()->json([
                'id' => $id
            ]);
        }
    }

}
