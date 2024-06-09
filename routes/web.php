<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogOutController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('home');
});

Route::get('/tienda', function () {
    return view('tienda');
});

//ARCHIVO REGISTER.BLADE.PHP
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register');

//->name sirve para darle un nombre a la ruta, con esto configurado podemos poner en nuestro href deseado ese nombre, 
//que siempre que cambiemos la ruta lo va a hacer automatico sin necesidad de que estemos cambiando la ruta en TODOS los archivos

//ARCHIVO LOGIN.BLADE.PHP
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login');

//ARCHIVO REGISTER.BLADE.PHP
Route::get('/muro', [PostController::class, 'index'])->name('posts.index')->middleware('auth');
//middleware sirve para revisar que el usuario este autenticado antes de mostrar el index

//Route::get('/logout', [LogOutController::class, 'index'])->name('login');
Route::post('/logout', [LogOutController::class, 'store'])->name('logout');