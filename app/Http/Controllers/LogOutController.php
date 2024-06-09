<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogOutController extends Controller
{
    //
    public function store() {
        auth()->logout();

        return redirect()->route('login');
    }
}
