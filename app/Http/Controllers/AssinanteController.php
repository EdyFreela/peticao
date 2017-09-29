<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Peticao;
use App\Assinante;
use DB;
use Session;

class AssinanteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->get('peticao_id');

        $item = Peticao::find($id);

        $input = new Assinante(array(
            'peticao_id'  => $id,
            'nome'        => $request->get('nome'),
            'sobrenome'   => $request->get('sobrenome'),
            'email'       => $request->get('email')
        ));

        $votou = DB::table('assinantes')->where([
            ['peticao_id', '=', $id],
            ['email', '=', $request->get('email')],
        ])->count();

        if($votou<1){
            $input->save();
            Session::flash('message', '<h2><strong>OBRIGADO!</strong> São pessoas como você que estão fazendo a diferença.</h2>');
            return view('thanks', compact('item', 'input'));
        }else{
            Session::flash('message', '<h2><strong>ATENÇÃO!</strong> Só é permitido um voto por email para cada petição.</h2>');
            return view('thanks', compact('item', 'input'));
        }
    }
}