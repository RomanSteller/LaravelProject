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
        $valid = $request->validate([
            'login_input' => 'required|min:4|max:100',
            'password_input' => 'required|min:6|max:50',
            'mail_input' => 'required|email',
            'user_agree_input' => 'required|accepted'
        ]);

        if ($request['password_repeat_input']=$request['password_input']){
            $user = User::create([
                'login' => $request['login_input'],
                'password' => Hash::make($request['password_input']),
                'passwordRepeat' => $request['password_repeat_input'],
                'email' => $request['mail_input']

                //'name' => 'AAA',//Надо изменить базу, а то ругается что отправляю null
                //'role' => 'user',//Надо изменить базу, а то ругается что отправляю null
                //'photo' => 'AAA'//Надо изменить базу, а то ругается что отправляю null
            ]);

            if($user){

            }
        }
    }

    public function authUser(Request $request){
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
