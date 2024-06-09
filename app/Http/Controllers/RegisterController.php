<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //Index se pone en los GET de web.php y store se le pone a los POST de web.php
    public function index() {
        return view('./auth/register');
    }

    public function store(Request $request){
        //Debuguea todo el codigo
        //dd($request);

        //Solo envia un pedido para ver name, se hace con los name de los input del form
        //dd($request->get('name'));

        //VALIDACION
        $request->validate([
            'name' => 'required|max:20',
            'username' => 'required|unique:users|min:3|max:15',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'username' => Str::slug($request->username), //str::slug sirve para setear el string como una url, elimina mayusculas, acentos, espacios, etc (La contra es que permite usuarios duplicados[Linea 43])
            'email' => $request->email,
            'password' => $request->password
            //En Laravel9 para codificar los passwords deberiamos tener algo asi = 'password' => Hash::make($request->password)
            //Y deberiamos importar Use Illuminate\Support\Facades\Hash;
        ]);
        //User es el unico Model que viene por defecto en laravel (Pregunta de entrevista)
        //create() es equivalente a INSERT INTO tablaejemplo
        //Para que no nos de un error, los campos que no vienen por defecto en user hay que agregarlos en Model/User.php en la parte de 'fillable' 
        //(Estos campos vienen por defecto: name, email & password)
        //Para evitar los duplicados podemos poner ->unique() en el username que creamos en migrate

        //AUTENTICAR UN USUARIO
        //auth()->attempt([
        //    'email' => $request->email,
        //    'password' => $request->password
        //]);
        //attempt devuelve un boolean que dice si el usuario se autentico o no con los datos que le pedimos

        //OTRA FORMA DE AUTENTICAR
        auth()->attempt($request->only('email','password'));
        
        //REDIRECCIONAR
        return redirect()->route('posts.index');
    }
}
