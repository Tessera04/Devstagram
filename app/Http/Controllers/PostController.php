<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(User $user){
        return view('dashboard', ['user' => $user]);
    }

    //create nos permite tener la vista del formulario
    public function create(){
        return view('posts.create');
    }

    //Estos permiten insertar en la base de datos
    public function store(Request $request){
        $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen'=>'required'
        ]);

        /*Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);*/

            //Otra forma de crear registros
            // $post = new Post;
            // $post->titulo = $request->titulo;
            // $post->descripcion = request->descripcion;
            // $post->imagen = request->imagen;
            // $post->user_id = auth()->user()->id;
            // $post->save();

        //Esto hace lo mismo que los dos de arriba, es a gusto de uno como subimos los datos a la base
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
