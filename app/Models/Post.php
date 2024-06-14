<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //Esta parte muestra los campos que se deben rellenar en la base de datos
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];
}
