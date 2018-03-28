<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Peticao extends Model
{

    use Sluggable;

    public $fillable = [
        'title', 'slug', 'descricao', 'twitterhashtags',
        'ativo_es', 'redirecionar_es', 'redirecionar_url_es', 'title_es', 'slug_es', 'descricao_es', 'twitterhashtags_es',
        'ativo_it', 'redirecionar_it', 'redirecionar_url_it', 'title_it', 'slug_it', 'descricao_it', 'twitterhashtags_it',
        'ativo_en', 'redirecionar_en', 'redirecionar_url_en', 'title_en', 'slug_en', 'descricao_en', 'twitterhashtags_en',
        'ativo_fr', 'redirecionar_fr', 'redirecionar_url_fr', 'title_fr', 'slug_fr', 'descricao_fr', 'twitterhashtags_fr',
        'mostrar_progresso', 'imagem', 'objetivo', 'assinaturas_fisica'
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
            ],
            'slug_es' => [
                'source' => 'title_es'
            ],
            'slug_it' => [
                'source' => 'title_it'
            ],
            'slug_en' => [
                'source' => 'title_en'
            ],
            'slug_fr' => [
                'source' => 'title_fr'
            ]
        ];
    }
}
