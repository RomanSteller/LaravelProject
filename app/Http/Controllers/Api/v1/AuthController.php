<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function createUser(AuthRequest $request){
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
}
