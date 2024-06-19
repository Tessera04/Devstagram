<?php
//laravel.com/docs/9.x/controllers

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogOutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ComentarioController;


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

//ARCHIVO LOGIN/LOGOUT.BLADE.PHP
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login');
//Route::get('/logout', [LogOutController::class, 'index'])->name('login');
Route::post('/logout', [LogOutController::class, 'store'])->name('logout');

//Rutas para el perfil
Route::get('/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index')->middleware('auth');
Route::post('/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store')->middleware('auth');

//ARCHIVO REGISTER.BLADE.PHP
//De este modo se ponen url mas estaticas, debajo se ve como seria para que salga cada muro con su nombre
//Route::get('/muro', [PostController::class, 'index'])->name('posts.index')->middleware('auth');
//middleware sirve para revisar que el usuario este autenticado antes de mostrar el index
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index')->middleware('auth');

//POSTS.CREATE
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
//Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
//Podemos mejorar la sintaxis de arriba de la siguiente forma mostrando el nickname
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show')->middleware('auth');

//Comentarios
Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');
//Delete
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');

//Likear fotos
Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');


