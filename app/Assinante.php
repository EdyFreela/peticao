<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Assinante extends Model
{

    public $fillable = [
        'peticao_id', 'nome', 'sobrenome', 'email', 'ip'
    ];

}
