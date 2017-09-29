<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Configuracao extends Model
{

    public $fillable = [
        'type', 'name', 'value'
    ];

}
