<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Peticao;
use App\Assinante;
use DB;
use App;
use Illuminate\Support\Facades\Session;

class PeticaoController extends Controller
{
    /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function index(Request $request)
    {
        #$items = Peticao::orderBy('id','DESC')->paginate(5);

        $items = DB::table('peticaos')
                    #->leftJoin('assinantes', 'peticaos.id', '=', 'assinantes.peticao_id')
                    #->selectRaw('peticaos.*, count(assinantes.peticao_id) as total')
                    #->groupBy('assinantes.peticao_id')
                    ->orderBy('created_at', 'DESC')
                    ->paginate(5);

        return view('peticaos.index',compact('items'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function create()
    {
        return view('peticaos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // VALIDAR COMUM
        $validate_comum = [
            'objetivo' => 'required|numeric',
            'assinaturas_fisica' => 'numeric',
            'imagem' => 'required'
        ];

        // VALIDAR PORTUGUES
        $validate_pt = [
            'title' => 'required',
            'descricao' => 'required',
            'conteudo' => 'required',
            'peticao' => 'required',
            'twitterhashtags' => 'required'
        ];

        // VALIDAR ESPANHOL
        $validate_es = [];

        if($request->get('ativo_es')=='Y'){
            if($request->get('redirecionar_es')){
                $validate_es = [
                    'redirecionar_url_es' => 'required'
                ];
            }else{
                $validate_es = [
                    'title_es' => 'required',
                    'descricao_es' => 'required',
                    'conteudo_es' => 'required',
                    'peticao_es' => 'required',
                    'twitterhashtags_es' => 'required'
                ];
            }
        }

        // VALIDAR ITALIANO
        $validate_it = [];

        if($request->get('ativo_it')=='Y'){
            if($request->get('redirecionar_it')){
                $validate_it = [
                    'redirecionar_url_it' => 'required'
                ];
            }else{
                $validate_it = [
                    'title_it' => 'required',
                    'descricao_it' => 'required',
                    'conteudo_it' => 'required',
                    'peticao_it' => 'required',
                    'twitterhashtags_it' => 'required'
                ];
            }            
        }        
        // VALIDAR INGLES
        $validate_en = [];

        if($request->get('ativo_en')=='Y'){
            if($request->get('redirecionar_en')){
                $validate_en = [
                    'redirecionar_url_en' => 'required'
                ];
            }else{
                $validate_en = [
                    'title_en' => 'required',
                    'descricao_en' => 'required',
                    'conteudo_en' => 'required',
                    'peticao_en' => 'required',
                    'twitterhashtags_en' => 'required'
                ];
            }
        } 

        $validate_arr = array_merge($validate_comum, $validate_pt, $validate_es, $validate_it, $validate_en);

        $this->validate($request, $validate_arr);

        $file = $request->file('imagem');

        $file->move(env('IMAGEM_PETICAO_PATH'), $file->getClientOriginalName());

        $input = new Peticao(array(
            'mostrar_progresso'    => $request->get('mostrar_progresso'),
            'objetivo'             => $request->get('objetivo'),
            'assinaturas_fisica'   => $request->get('assinaturas_fisica'),
            'imagem'               => $file->getClientOriginalName(), 
            
            'title'                => $request->get('title'), 
            'descricao'            => $request->get('descricao'), 
            'conteudo'             => $request->get('conteudo'), 
            'peticao'              => $request->get('peticao'), 
            'twitterhashtags'      => $request->get('twitterhashtags'),

            'ativo_es'             => $request->get('ativo_es'), 
            'redirecionar_es'      => $request->get('redirecionar_es'), 
            'redirecionar_url_es'  => $request->get('redirecionar_url_es'), 
            'title_es'             => $request->get('title_es'), 
            'descricao_es'         => $request->get('descricao_es'), 
            'conteudo_es'          => $request->get('conteudo_es'), 
            'peticao_es'           => $request->get('peticao_es'), 
            'twitterhashtags_es'   => $request->get('twitterhashtags_es'),         

            'ativo_it'             => $request->get('ativo_it'), 
            'redirecionar_it'      => $request->get('redirecionar_it'), 
            'redirecionar_url_it'  => $request->get('redirecionar_url_it'), 
            'title_it'             => $request->get('title_it'), 
            'descricao_it'         => $request->get('descricao_it'), 
            'conteudo_it'          => $request->get('conteudo_it'), 
            'peticao_it'           => $request->get('peticao_it'), 
            'twitterhashtags_it'   => $request->get('twitterhashtags_it'), 

            'ativo_en'             => $request->get('ativo_en'), 
            'redirecionar_en'      => $request->get('redirecionar_en'), 
            'redirecionar_url_en'  => $request->get('redirecionar_url_en'), 
            'title_en'             => $request->get('title_en'), 
            'descricao_en'         => $request->get('descricao_en'), 
            'conteudo_en'          => $request->get('conteudo_en'), 
            'peticao_en'           => $request->get('peticao_en'), 
            'twitterhashtags_en'   => $request->get('twitterhashtags_en'),
        ));

        $input->save();

        return redirect()->route('peticaos.index')
                        ->with('success','Petição criada com sucesso');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {

        $slug_idioma    = DB::table('peticaos')->where('slug', $slug)->first();
        $slug_idioma_es = DB::table('peticaos')->where('slug_es', $slug)->first();
        $slug_idioma_it = DB::table('peticaos')->where('slug_it', $slug)->first();
        $slug_idioma_en = DB::table('peticaos')->where('slug_en', $slug)->first();

        if($slug_idioma != null){
            $idioma = 'pt';
            $item   = DB::table('peticaos')
                        ->select('id', 'mostrar_progresso', 'objetivo', 'assinaturas_fisica', 'imagem', 'created_at', 'title', 'slug', 'descricao', 'conteudo', 'peticao', 'twitterhashtags')
                        ->where('slug', $slug)
                        ->first();            
            App::setLocale('pt-br');
        }else if($slug_idioma_es != null){
            $idioma = 'es';
            $item   = DB::table('peticaos')
                        ->select('id', 'mostrar_progresso', 'objetivo', 'assinaturas_fisica', 'imagem', 'created_at', 'ativo_es', 'redirecionar_es', 'redirecionar_url_es', 'title_es as title', 'slug_es as slug', 'descricao_es as descricao', 'conteudo_es as conteudo', 'peticao_es as peticao', 'twitterhashtags_es as twitterhashtags')
                        ->where('slug_es', $slug)
                        ->first();
            App::setLocale('es');
            if($item->redirecionar_es=='y'){
                return redirect($item->redirecionar_url_es);
            }            
        }else if($slug_idioma_it != null){
            $idioma = 'it';
            $item   = DB::table('peticaos')
                        ->select('id', 'mostrar_progresso', 'objetivo', 'assinaturas_fisica', 'imagem', 'created_at', 'ativo_it', 'redirecionar_it', 'redirecionar_url_it', 'title_it as title', 'slug_it as slug', 'descricao_it as descricao', 'conteudo_it as conteudo', 'peticao_it as peticao', 'twitterhashtags_it as twitterhashtags')
                        ->where('slug_it', $slug)
                        ->first();
            App::setLocale('it');

            if($item->redirecionar_it=='y'){
                return redirect($item->redirecionar_url_it);
            }

        }else if($slug_idioma_en != null){
            $idioma = 'en';
            $item   = DB::table('peticaos')
                        ->select('id', 'mostrar_progresso', 'objetivo', 'assinaturas_fisica', 'imagem', 'created_at', 'ativo_en', 'redirecionar_en', 'redirecionar_url_en', 'title_en as title', 'slug_en as slug', 'descricao_en as descricao', 'conteudo_en as conteudo', 'peticao_en as peticao', 'twitterhashtags_en as twitterhashtags')
                        ->where('slug_en', $slug)
                        ->first();
            App::setLocale('en');

            if($item->redirecionar_en=='y'){
                return redirect($item->redirecionar_url_en);
            }
        }

        $apoiantes  = DB::table('assinantes')->where('peticao_id', $item->id)->count();


        //echo $idioma.'<br>'.session('locale'); die;
        //dd($item);
        //echo $slug;
        //echo '<hr>';
        //echo $idioma;
        //die;


        $apoiantes_porcetagem = ( ($item->assinaturas_fisica + $apoiantes) / $item->objetivo ) * 100;
        $item2 = array('apoiantes' => $apoiantes, 'valuenow' => $apoiantes_porcetagem);

        if(session('locale')==null){
            $locale = App::getLocale();
            App::setLocale($locale);
        }

        return view('peticaos.show', compact('item', 'item2'));
    }    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Peticao::find($id);

        return view('peticaos.edit',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // VALIDAR COMUM
        $validate_comum = [
            'objetivo' => 'required|numeric',
            'assinaturas_fisica' => 'numeric'
        ];

        // VALIDAR PORTUGUES
        $validate_pt = [
            'title' => 'required',
            'descricao' => 'required',
            'conteudo' => 'required',
            'peticao' => 'required',
            'twitterhashtags' => 'required'
        ];

        // VALIDAR ESPANHOL
        $validate_es = [];

        if($request->get('ativo_es')=='Y'){
            if($request->get('redirecionar_es')){
                $validate_es = [
                    'redirecionar_url_es' => 'required'
                ];
            }else{
                $validate_es = [
                    'title_es' => 'required',
                    'descricao_es' => 'required',
                    'conteudo_es' => 'required',
                    'peticao_es' => 'required',
                    'twitterhashtags_es' => 'required'
                ];
            }
        }

        // VALIDAR ITALIANO
        $validate_it = [];

        if($request->get('ativo_it')=='Y'){
            if($request->get('redirecionar_it')){
                $validate_it = [
                    'redirecionar_url_it' => 'required'
                ];
            }else{
                $validate_it = [
                    'title_it' => 'required',
                    'descricao_it' => 'required',
                    'conteudo_it' => 'required',
                    'peticao_it' => 'required',
                    'twitterhashtags_it' => 'required'
                ];
            }            
        }        
        // VALIDAR INGLES
        $validate_en = [];

        if($request->get('ativo_en')=='Y'){
            if($request->get('redirecionar_en')){
                $validate_en = [
                    'redirecionar_url_en' => 'required'
                ];
            }else{
                $validate_en = [
                    'title_en' => 'required',
                    'descricao_en' => 'required',
                    'conteudo_en' => 'required',
                    'peticao_en' => 'required',
                    'twitterhashtags_en' => 'required'
                ];
            }
        } 

        $validate_arr = array_merge($validate_comum, $validate_pt, $validate_es, $validate_it, $validate_en);

        $this->validate($request, $validate_arr);

        // VERIFICA SE OUVE ALTERAÇÃO NA IMAGEM
        $item = Peticao::find($id);
        $img_saved = $item->imagem;
        $file = $request->file('imagem');

        if($file!=null){
            $img_new = $file->getClientOriginalName();
        }else{
            $img_new = $img_saved;
        }

        if($img_saved == $img_new){

            $input = array(
                'mostrar_progresso'    => $request->get('mostrar_progresso'),
                'objetivo'             => $request->get('objetivo'),
                'assinaturas_fisica'   => $request->get('assinaturas_fisica'),
                
                'title'                => $request->get('title'), 
                'descricao'            => $request->get('descricao'), 
                'conteudo'             => $request->get('conteudo'), 
                'peticao'              => $request->get('peticao'), 
                'twitterhashtags'      => $request->get('twitterhashtags'),
            );

            $input_es = array(
                'ativo_es'             => $request->get('ativo_es'), 
                'redirecionar_es'      => $request->get('redirecionar_es'), 
                'redirecionar_url_es'  => $request->get('redirecionar_url_es'), 
                'title_es'             => $request->get('title_es'), 
                'descricao_es'         => $request->get('descricao_es'), 
                'conteudo_es'          => $request->get('conteudo_es'), 
                'peticao_es'           => $request->get('peticao_es'), 
                'twitterhashtags_es'   => $request->get('twitterhashtags_es'),
            );

            $input_it = array(         
                'ativo_it'             => $request->get('ativo_it'), 
                'redirecionar_it'      => $request->get('redirecionar_it'), 
                'redirecionar_url_it'  => $request->get('redirecionar_url_it'), 
                'title_it'             => $request->get('title_it'), 
                'descricao_it'         => $request->get('descricao_it'), 
                'conteudo_it'          => $request->get('conteudo_it'), 
                'peticao_it'           => $request->get('peticao_it'), 
                'twitterhashtags_it'   => $request->get('twitterhashtags_it'), 
            );

            $input_en = array( 
                'ativo_en'             => $request->get('ativo_en'), 
                'redirecionar_en'      => $request->get('redirecionar_en'), 
                'redirecionar_url_en'  => $request->get('redirecionar_url_en'), 
                'title_en'             => $request->get('title_en'), 
                'descricao_en'         => $request->get('descricao_en'), 
                'conteudo_en'          => $request->get('conteudo_en'), 
                'peticao_en'           => $request->get('peticao_en'), 
                'twitterhashtags_en'   => $request->get('twitterhashtags_en'),
            );
        }else{

            $file = $request->file('imagem');
            
            $file->move(env('IMAGEM_PETICAO_PATH'), $file->getClientOriginalName());

            $path_img_saved = public_path(env('IMAGEM_PETICAO_PATH').DIRECTORY_SEPARATOR.$img_saved);
            
            if (file_exists($path_img_saved))
            {
                unlink($path_img_saved);
            }

            $input = array(
                'mostrar_progresso'    => $request->get('mostrar_progresso'),
                'objetivo'             => $request->get('objetivo'),
                'assinaturas_fisica'   => $request->get('assinaturas_fisica'),
                'imagem'               => $file->getClientOriginalName(), 
                
                'title'                => $request->get('title'), 
                'descricao'            => $request->get('descricao'), 
                'conteudo'             => $request->get('conteudo'), 
                'peticao'              => $request->get('peticao'), 
                'twitterhashtags'      => $request->get('twitterhashtags'),
            );

            $input_es = array(
                'ativo_es'             => $request->get('ativo_es'), 
                'redirecionar_es'      => $request->get('redirecionar_es'), 
                'redirecionar_url_es'  => $request->get('redirecionar_url_es'), 
                'title_es'             => $request->get('title_es'), 
                'descricao_es'         => $request->get('descricao_es'), 
                'conteudo_es'          => $request->get('conteudo_es'), 
                'peticao_es'           => $request->get('peticao_es'), 
                'twitterhashtags_es'   => $request->get('twitterhashtags_es'),
            );         

            $input_it = array(
                'ativo_it'             => $request->get('ativo_it'), 
                'redirecionar_it'      => $request->get('redirecionar_it'), 
                'redirecionar_url_it'  => $request->get('redirecionar_url_it'), 
                'title_it'             => $request->get('title_it'), 
                'descricao_it'         => $request->get('descricao_it'), 
                'conteudo_it'          => $request->get('conteudo_it'), 
                'peticao_it'           => $request->get('peticao_it'), 
                'twitterhashtags_it'   => $request->get('twitterhashtags_it'),
            );

            $input_en = array(
                'ativo_en'             => $request->get('ativo_en'), 
                'redirecionar_en'      => $request->get('redirecionar_en'), 
                'redirecionar_url_en'  => $request->get('redirecionar_url_en'), 
                'title_en'             => $request->get('title_en'), 
                'descricao_en'         => $request->get('descricao_en'), 
                'conteudo_en'          => $request->get('conteudo_en'), 
                'peticao_en'           => $request->get('peticao_en'), 
                'twitterhashtags_en'   => $request->get('twitterhashtags_en'),
            );
        }

        Peticao::find($id)->update($input);
        Peticao::find($id)->update($input_es);
        Peticao::find($id)->update($input_it);
        Peticao::find($id)->update($input_en);

        return redirect()->route('peticaos.index')
                        ->with('success','Petição atualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Peticao::find($id);
        $img_saved = $item->imagem;
        $path_img_saved = public_path(env('IMAGEM_PETICAO_PATH').DIRECTORY_SEPARATOR.$img_saved);
        if (file_exists($path_img_saved))
        {
            unlink($path_img_saved);
        }        

        Peticao::find($id)->delete();
        return redirect()->route('peticaos.index')
                        ->with('success','Petição deletada com sucesso');
    }

    /**
     * Export to CSV.
     * http://www.maatwebsite.nl/laravel-excel/docs/export
     * https://github.com/Maatwebsite/Laravel-Excel
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function export($id)
    {
        $peticao    = DB::table('peticaos')
                            ->select('slug')
                            ->where('id', $id)
                            ->first();

        $apoiantes  = DB::table('assinantes')
                            ->select('nome', 'sobrenome', 'email', 'cidade', 'estado', 'created_at')
                            ->where('peticao_id', $id)
                            ->get();

        /*
         * CONVERT STDCLASS TO OBJECT
         */
        $apoiantes_arr = array();

        foreach($apoiantes as $key=>$value){
            $apoiantes_arr[] = array(
                                    'nome'=>$value->nome,
                                    'sobrenome'=>$value->sobrenome,
                                    'email'=>$value->email,
                                    'cidade'=>$value->cidade,
                                    'estado'=>$value->estado,
                                    'created_at'=>$value->created_at,
            );
        }

        $filename = $peticao->slug.'-['.date('d-m-Y-H-i-s').']';

        \Excel::create($filename, function($excel) use ($apoiantes_arr) {

            $excel->sheet('Excel sheet', function($sheet) use ($apoiantes_arr) {

                $sheet->setOrientation('landscape');

                $sheet->fromArray($apoiantes_arr);

            });

        })->export('csv');
    }

}
