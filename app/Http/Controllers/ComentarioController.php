<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

use App\Http\Requests;
use App\Comentario;
use Auth;

class ComentarioController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = new Comentario(array(
            'peticao_id' => $request->get('peticao_id'),
            'user_id'    => Auth::user()->id,
            'comentario' => $request->get('comentario')
        ));

        $input->save();

        return Redirect::to(URL::previous() . "#comente")->with('success', 'Comentario adicionado com sucesso.');

    }
}
