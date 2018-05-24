<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeticaoConteudo extends Model
{

    public $fillable = [
        'peticao_id', 'idioma', 'conteudo', 'peticao'
    ];
}
