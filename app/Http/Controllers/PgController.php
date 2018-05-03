<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


class PgController extends Controller
{
    /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function privacy(Request $request)
    {
        $item = new \stdClass();
        $item->title             = 'Entre em Ação';
        $item->facebooktitulo    = 'Políticas de Privacidade - Instituto Plinio Corrêa de Oliveira';
        $item->facebookdescricao = 'Esta Política de Privacidade foi formulada com o intuito de manter a privacidade e a segurança das informações coletadas de nossos clientes e usuários.';
        $item->slug              = 'politica-de-privacidade';
        $item->imagem            = 'selo-ipco.png';

        return view('pg.privacy', compact('item'));
    }

    /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function terms(Request $request)
    {
        $item = new \stdClass();
        $item->title             = 'Entre em Ação';
        $item->facebooktitulo    = 'Políticas de Privacidade - Instituto Plinio Corrêa de Oliveira';
        $item->facebookdescricao = 'Esta Política de Privacidade foi formulada com o intuito de manter a privacidade e a segurança das informações coletadas de nossos clientes e usuários.';
        $item->slug              = 'politica-de-privacidade';
        $item->imagem            = 'selo-ipco.png';

        return view('pg.terms', compact('item'));
    }

}
