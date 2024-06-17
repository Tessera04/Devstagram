<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    //Validar campo
    public function store(Request $request, User $user, Post $post){
        $request->validate([
            'comentario' => 'required|max:255'
        ]);

        //Almacenar el resultado
        Comentario::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comentario' => $request->comentario
        ]);

        //Imprimir un mensaje
        return back()->with('mensaje', 'Comentario agregado con éxito');
    }
}
