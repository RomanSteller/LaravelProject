<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\Articles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function reg()
    {
        return view('auth.reg');
    }

    public function log()
    {
        return view('auth.auth');
    }

    public function createUser(Request $request){

        if ($request['password_repeat_input']=$request['password_input']){
            $user = User::create([
                'login' => $request['login'],
                'password' => Hash::make($request['password']),
                'email' => $request['email']
            ]);

            if($user){

            }
        }
    }

    public function authUser(AuthRequest $request){
        $login = $request['login_input'];
        $user = User::where('login',$login)->first();

        if(!$user || !Hash::check($request['password_input'],$user['password'])){
            return response()->json([
                "message" => "Пользователь не найден"
            ])->setStatusCode(401);
        }else{
            session(['id' => $user['id']]);
            $id = session('id');
            return redirect(route(('home')));
        }
    }
}
