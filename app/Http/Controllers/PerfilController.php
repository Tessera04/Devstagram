<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    //
    public function index(){
        return view('profile.index');
    }

    public function store(Request $request){

        $request->request->add(['username' => Str::slug($request->username)]);

        $request->validate([
            'username' => ['required',Rule::unique('users', 'username')->ignore(auth()->user()),'min:3','max:20', 'not_in:editar-perfil']
        ]);

        if($request->imagen){
            $manager = new ImageManager(new Driver());
            $imagen = $request->file('imagen');
            $nombreImagen = Str::uuid() . "." . $imagen->extension();
            $imagenServidor = $manager->read($imagen);
            $imagenServidor->scale(1000, 1000);
            $imagenesPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenesPath);
        }

        //Guardar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();

        //Redireccionar
        return redirect()->route('posts.index', $usuario->username);
    }
}
