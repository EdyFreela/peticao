<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Configuracao;
use DB;

class ConfiguracaoController extends Controller
{
    /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function index(Request $request)
    {
        $mail = DB::table('configuracaos')
        			->select('name', 'value')
					->where('type', 'mail')
                    ->get();

        return view('configuracaos.index', compact('mail'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    	if($id=='mail'){    		
	        $data = array(
				array('type' => $id, 'name' => 'driver',     'value' => $request->driver),
				array('type' => $id, 'name' => 'host',       'value' => $request->host),
				array('type' => $id, 'name' => 'port',       'value' => $request->port),
				array('type' => $id, 'name' => 'username',   'value' => $request->username),
				array('type' => $id, 'name' => 'password',   'value' => $request->password),
				array('type' => $id, 'name' => 'encryption', 'value' => $request->encryption),
	        );

    	}
	        
	    DB::table('configuracaos')->where('type', '=', $id)->delete();

    	DB::table('configuracaos')->insert($data);
       
        return redirect()->route('configuracaos.index')
                        ->with('success','Configurações Atualizadas com sucesso');

    }    
}
