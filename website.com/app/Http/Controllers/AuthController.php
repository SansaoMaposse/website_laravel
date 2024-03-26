<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;



class AuthController extends Controller
{
    public function login(){

        return view( 'auth.login' );
    }

    public function register(){
        return view('auth.register');
    }

    public function forgot(){
        return view( 'auth.forgot' );
    }

   public function auth_login(Request $request){
                    dd($request->all());
   }

    public function create_user( Request $request ){

        request()->validate([

            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $save = new  User();
        $save->name = trim($request->name);
        $save->email = trim($request->email);
        $save->password = Hash::make($request->password);
        $save->remember_token = Str::random(40) ;
        $save->save();

        //Mail::to($save->email)->send(new RegisterMail($save));

        return redirect('login')->with('Parabéns', 'Registrado com sucesso!');
    }



}
