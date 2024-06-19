<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerfilController extends Controller
{
    //
    public function index(){
        return view('profile.index');
    }

    public function store(Request $request){

        

        $request->validate([
            'username' => 'required|unique:users|min:3|max:20'
        ]);
    }
}
