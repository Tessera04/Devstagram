@extends('layouts.app')

@section('titulo')
    Pagina Principal
@endsection

@section('contenido')

    <x-listar-post :posts="$posts"/>
<!--For else es una mecanica unica de laravel, junta un if y un for each
    forelse ($posts as $post)
        
    empty
        
    endforelse-->

@endsection