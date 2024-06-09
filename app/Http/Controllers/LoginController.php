<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function store(Request $request){
        //dd('Autenticando...'); //El dd tiene un uso similar a console.log en JS

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(!auth()->attempt($request->only('email','password'), $request->remember)){
            return back()->with('mensaje', 'Credenciales Incorrectas');
            //Lo que se le dice con este codigo es return back (volve atras) con este mensaje
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
