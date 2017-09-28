<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Comentario extends Model
{

    public $fillable = [
        'user_id', 'peticao_id', 'comentario'
    ];

}
