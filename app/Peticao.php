<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Peticao extends Model
{

    use Sluggable;

    public $fillable = [
        'title', 'slug', 'conteudo', 'peticao', 'mostrar_progresso', 'imagem', 'objetivo', 'assinaturas_fisica', 'twitterhashtags'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
