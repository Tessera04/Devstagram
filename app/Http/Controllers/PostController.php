<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index(User $user){

        $posts = Post::where('user_id', $user->id)->latest()->paginate(16);

        //Con este pedazo de codigo le decimos a la vista "dashboard" lo que tenemos que ver
        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
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

    public function show(User $user, Post $post){
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post){
        //Elimina el post, pero no la imagen
        $post->delete();

        //Elimina la imagen
        $imagen_path = public_path('uploads/' . $post->imagen);

        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
