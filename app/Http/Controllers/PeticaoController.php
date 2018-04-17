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

        $items = DB::table('peticaos')
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
            'twitterhashtags' => 'required',
            'facebooktitulo' => 'required',
            'facebookdescricao' => 'required'
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
                    'twitterhashtags_es' => 'required',
                    'facebooktitulo_es' => 'required',
                    'facebookdescricao_es' => 'required'                    
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
                    'twitterhashtags_it' => 'required',
                    'facebooktitulo_it' => 'required',
                    'facebookdescricao_it' => 'required'
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
                    'twitterhashtags_en' => 'required',
                    'facebooktitulo_en' => 'required',
                    'facebookdescricao_en' => 'required'
                ];
            }
        } 

        // VALIDAR FRANCES
        $validate_fr = [];

        if($request->get('ativo_fr')=='Y'){
            if($request->get('redirecionar_fr')){
                $validate_fr = [
                    'redirecionar_url_fr' => 'required'
                ];
            }else{
                $validate_fr = [
                    'title_fr' => 'required',
                    'descricao_fr' => 'required',
                    'conteudo_fr' => 'required',
                    'peticao_fr' => 'required',
                    'twitterhashtags_fr' => 'required',
                    'facebooktitulo_fr' => 'required',
                    'facebookdescricao_fr' => 'required'
                ];
            }
        }

        // VALIDAR ALEMAO
        $validate_de = [];

        if($request->get('ativo_de')=='Y'){
            if($request->get('redirecionar_de')){
                $validate_de = [
                    'redirecionar_url_de' => 'required'
                ];
            }else{
                $validate_de = [
                    'title_de' => 'required',
                    'descricao_de' => 'required',
                    'conteudo_de' => 'required',
                    'peticao_de' => 'required',
                    'twitterhashtags_de' => 'required',
                    'facebooktitulo_de' => 'required',
                    'facebookdescricao_de' => 'required'
                ];
            }
        }

        $validate_arr = array_merge($validate_comum, $validate_pt, $validate_es, $validate_it, $validate_en, $validate_fr, $validate_de);

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
            'twitterhashtags'      => $request->get('twitterhashtags'),
            'facebooktitulo'       => $request->get('facebooktitulo'),
            'facebookdescricao'    => $request->get('facebookdescricao'),

            'ativo_es'             => $request->get('ativo_es'), 
            'redirecionar_es'      => $request->get('redirecionar_es'), 
            'redirecionar_url_es'  => $request->get('redirecionar_url_es'), 
            'title_es'             => $request->get('title_es'), 
            'descricao_es'         => $request->get('descricao_es'),  
            'twitterhashtags_es'   => $request->get('twitterhashtags_es'),
            'facebooktitulo_es'    => $request->get('facebooktitulo_es'),
            'facebookdescricao_es' => $request->get('facebookdescricao_es'),

            'ativo_it'             => $request->get('ativo_it'), 
            'redirecionar_it'      => $request->get('redirecionar_it'), 
            'redirecionar_url_it'  => $request->get('redirecionar_url_it'), 
            'title_it'             => $request->get('title_it'), 
            'descricao_it'         => $request->get('descricao_it'),  
            'twitterhashtags_it'   => $request->get('twitterhashtags_it'),
            'facebooktitulo_it'    => $request->get('facebooktitulo_it'),
            'facebookdescricao_it' => $request->get('facebookdescricao_it'),            

            'ativo_en'             => $request->get('ativo_en'), 
            'redirecionar_en'      => $request->get('redirecionar_en'), 
            'redirecionar_url_en'  => $request->get('redirecionar_url_en'), 
            'title_en'             => $request->get('title_en'), 
            'descricao_en'         => $request->get('descricao_en'), 
            'twitterhashtags_en'   => $request->get('twitterhashtags_en'),
            'facebooktitulo_en'    => $request->get('facebooktitulo_en'),
            'facebookdescricao_en' => $request->get('facebookdescricao_en'),            

            'ativo_fr'             => $request->get('ativo_fr'), 
            'redirecionar_fr'      => $request->get('redirecionar_fr'), 
            'redirecionar_url_fr'  => $request->get('redirecionar_url_fr'), 
            'title_fr'             => $request->get('title_fr'), 
            'descricao_fr'         => $request->get('descricao_fr'),  
            'twitterhashtags_fr'   => $request->get('twitterhashtags_fr'),
            'facebooktitulo_fr'    => $request->get('facebooktitulo_fr'),
            'facebookdescricao_fr' => $request->get('facebookdescricao_fr'),

            'ativo_de'             => $request->get('ativo_de'), 
            'redirecionar_de'      => $request->get('redirecionar_de'), 
            'redirecionar_url_de'  => $request->get('redirecionar_url_de'), 
            'title_de'             => $request->get('title_de'), 
            'descricao_de'         => $request->get('descricao_de'),  
            'twitterhashtags_de'   => $request->get('twitterhashtags_de'),
            'facebooktitulo_de'    => $request->get('facebooktitulo_de'),
            'facebookdescricao_de' => $request->get('facebookdescricao_de'),             
        ));

        $input->save();

        $lastInsertedId = $input->id;

        DB::table('peticaos_conteudos')->insert([
            ['peticao_id' => $lastInsertedId, 'idioma' => 'br', 'conteudo' => $request->get('conteudo'),    'peticao' => $request->get('peticao')],
            ['peticao_id' => $lastInsertedId, 'idioma' => 'es', 'conteudo' => $request->get('conteudo_es'), 'peticao' => $request->get('peticao_es')],
            ['peticao_id' => $lastInsertedId, 'idioma' => 'it', 'conteudo' => $request->get('conteudo_it'), 'peticao' => $request->get('peticao_it')],
            ['peticao_id' => $lastInsertedId, 'idioma' => 'en', 'conteudo' => $request->get('conteudo_en'), 'peticao' => $request->get('peticao_en')],
            ['peticao_id' => $lastInsertedId, 'idioma' => 'fr', 'conteudo' => $request->get('conteudo_fr'), 'peticao' => $request->get('peticao_fr')],
            ['peticao_id' => $lastInsertedId, 'idioma' => 'de', 'conteudo' => $request->get('conteudo_de'), 'peticao' => $request->get('peticao_de')]
        ]);

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
        $slug_idioma_fr = DB::table('peticaos')->where('slug_fr', $slug)->first();
        $slug_idioma_de = DB::table('peticaos')->where('slug_de', $slug)->first();

        if($slug_idioma != null){
            $idioma = 'pt';
            $sqlpeticao = DB::table('peticaos')
                        ->select('id', 'mostrar_progresso', 'objetivo', 'assinaturas_fisica', 'imagem', 'created_at', 'title', 'slug', 'descricao', 'twitterhashtags', 'facebooktitulo', 'facebookdescricao')
                        ->where('slug', $slug)
                        ->first();

            $sqlconteudo = DB::table('peticaos_conteudos')
                        ->select('conteudo', 'peticao')
                        ->where([['peticao_id', '=', $sqlpeticao->id], ['idioma', '=', 'br'],])
                        ->first();

            $item = (object) array_merge((array)$sqlpeticao, (array)$sqlconteudo);

            App::setLocale('pt-br');

        }else if($slug_idioma_es != null){
            $idioma = 'es';
            $sqlpeticao   = DB::table('peticaos')
                        ->select('id', 'mostrar_progresso', 'objetivo', 'assinaturas_fisica', 'imagem', 'created_at', 'ativo_es', 'redirecionar_es', 'redirecionar_url_es', 'title_es as title', 'slug_es as slug', 'descricao_es as descricao', 'twitterhashtags_es as twitterhashtags', 'facebooktitulo_es as facebooktitulo', 'facebookdescricao_es as facebookdescricao')
                        ->where('slug_es', $slug)
                        ->first();

            $sqlconteudo = DB::table('peticaos_conteudos')
                        ->select('conteudo', 'peticao')
                        ->where([['peticao_id', '=', $sqlpeticao->id], ['idioma', '=', 'es'],])
                        ->first();

            $item = (object) array_merge((array)$sqlpeticao, (array)$sqlconteudo);

            App::setLocale('es');
            if($item->redirecionar_es=='y'){
                return redirect($item->redirecionar_url_es);
            }            
        }else if($slug_idioma_it != null){
            $idioma = 'it';
            $sqlpeticao   = DB::table('peticaos')
                        ->select('id', 'mostrar_progresso', 'objetivo', 'assinaturas_fisica', 'imagem', 'created_at', 'ativo_it', 'redirecionar_it', 'redirecionar_url_it', 'title_it as title', 'slug_it as slug', 'descricao_it as descricao', 'twitterhashtags_it as twitterhashtags', 'facebooktitulo_it as facebooktitulo', 'facebookdescricao_it as facebookdescricao')
                        ->where('slug_it', $slug)
                        ->first();

            $sqlconteudo = DB::table('peticaos_conteudos')
                        ->select('conteudo', 'peticao')
                        ->where([['peticao_id', '=', $sqlpeticao->id], ['idioma', '=', 'it'],])
                        ->first();

            $item = (object) array_merge((array)$sqlpeticao, (array)$sqlconteudo);

            App::setLocale('it');

            if($item->redirecionar_it=='y'){
                return redirect($item->redirecionar_url_it);
            }

        }else if($slug_idioma_en != null){
            $idioma = 'en';
            $sqlpeticao   = DB::table('peticaos')
                        ->select('id', 'mostrar_progresso', 'objetivo', 'assinaturas_fisica', 'imagem', 'created_at', 'ativo_en', 'redirecionar_en', 'redirecionar_url_en', 'title_en as title', 'slug_en as slug', 'descricao_en as descricao', 'twitterhashtags_en as twitterhashtags', 'facebooktitulo_en as facebooktitulo', 'facebookdescricao_en as facebookdescricao')
                        ->where('slug_en', $slug)
                        ->first();

            $sqlconteudo = DB::table('peticaos_conteudos')
                        ->select('conteudo', 'peticao')
                        ->where([['peticao_id', '=', $sqlpeticao->id], ['idioma', '=', 'en'],])
                        ->first();

            $item = (object) array_merge((array)$sqlpeticao, (array)$sqlconteudo);

            App::setLocale('en');

            if($item->redirecionar_en=='y'){
                return redirect($item->redirecionar_url_en);
            }
        }else if($slug_idioma_fr != null){
            $idioma = 'fr';
            $sqlpeticao   = DB::table('peticaos')
                        ->select('id', 'mostrar_progresso', 'objetivo', 'assinaturas_fisica', 'imagem', 'created_at', 'ativo_fr', 'redirecionar_fr', 'redirecionar_url_fr', 'title_fr as title', 'slug_fr as slug', 'descricao_fr as descricao', 'twitterhashtags_fr as twitterhashtags', 'facebooktitulo_fr as facebooktitulo', 'facebookdescricao_fr as facebookdescricao')
                        ->where('slug_fr', $slug)
                        ->first();

            $sqlconteudo = DB::table('peticaos_conteudos')
                        ->select('conteudo', 'peticao')
                        ->where([['peticao_id', '=', $sqlpeticao->id], ['idioma', '=', 'fr'],])
                        ->first();

            $item = (object) array_merge((array)$sqlpeticao, (array)$sqlconteudo);

            App::setLocale('fr');

            if($item->redirecionar_fr=='y'){
                return redirect($item->redirecionar_url_fr);
            }
        }else if($slug_idioma_de != null){
            $idioma = 'de';
            $sqlpeticao   = DB::table('peticaos')
                        ->select('id', 'mostrar_progresso', 'objetivo', 'assinaturas_fisica', 'imagem', 'created_at', 'ativo_de', 'redirecionar_de', 'redirecionar_url_de', 'title_de as title', 'slug_de as slug', 'descricao_de as descricao', 'twitterhashtags_de as twitterhashtags', 'facebooktitulo_de as facebooktitulo', 'facebookdescricao_de as facebookdescricao')
                        ->where('slug_de', $slug)
                        ->first();

            $sqlconteudo = DB::table('peticaos_conteudos')
                        ->select('conteudo', 'peticao')
                        ->where([['peticao_id', '=', $sqlpeticao->id], ['idioma', '=', 'de'],])
                        ->first();

            $item = (object) array_merge((array)$sqlpeticao, (array)$sqlconteudo);

            App::setLocale('de');

            if($item->redirecionar_de=='y'){
                return redirect($item->redirecionar_url_de);
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
        $item  = Peticao::find($id);

        $item_br = DB::table('peticaos_conteudos')
                    ->select('conteudo', 'peticao')
                    ->where([['peticao_id', '=', $item->id], ['idioma', '=', 'br'],])
                    ->get();

        $item_es = DB::table('peticaos_conteudos')
                    ->select('conteudo', 'peticao')
                    ->where([['peticao_id', '=', $item->id], ['idioma', '=', 'es'],])
                    ->get();

        $item_it = DB::table('peticaos_conteudos')
                    ->select('conteudo', 'peticao')
                    ->where([['peticao_id', '=', $item->id], ['idioma', '=', 'it'],])
                    ->get();

        $item_en = DB::table('peticaos_conteudos')
                    ->select('conteudo', 'peticao')
                    ->where([['peticao_id', '=', $item->id], ['idioma', '=', 'en'],])
                    ->get();                                        

        $item_fr = DB::table('peticaos_conteudos')
                    ->select('conteudo', 'peticao')
                    ->where([['peticao_id', '=', $item->id], ['idioma', '=', 'fr'],])
                    ->get();

        $item_de = DB::table('peticaos_conteudos')
                    ->select('conteudo', 'peticao')
                    ->where([['peticao_id', '=', $item->id], ['idioma', '=', 'de'],])
                    ->get();                    

        //print($item_br[0]);
        //die;

        return view('peticaos.edit',compact('item', 'item_br', 'item_es', 'item_it', 'item_en', 'item_fr', 'item_de'));
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
            'twitterhashtags' => 'required',
            'facebooktitulo' => 'required',
            'facebookdescricao' => 'required'
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
                    'twitterhashtags_es' => 'required',
                    'facebooktitulo_es' => 'required',
                    'facebookdescricao_es' => 'required'
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
                    'twitterhashtags_it' => 'required',
                    'facebooktitulo_it' => 'required',
                    'facebookdescricao_it' => 'required'
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
                    'twitterhashtags_en' => 'required',
                    'facebooktitulo_en' => 'required',
                    'facebookdescricao_en' => 'required'
                ];
            }
        } 

        // VALIDAR FRANCES
        $validate_fr = [];

        if($request->get('ativo_fr')=='Y'){
            if($request->get('redirecionar_fr')){
                $validate_fr = [
                    'redirecionar_url_fr' => 'required'
                ];
            }else{
                $validate_fr = [
                    'title_fr' => 'required',
                    'descricao_fr' => 'required',
                    'twitterhashtags_fr' => 'required',
                    'facebooktitulo_fr' => 'required',
                    'facebookdescricao_fr' => 'required'
                ];
            }
        }

        // VALIDAR ALEMAO
        $validate_de = [];

        if($request->get('ativo_de')=='Y'){
            if($request->get('redirecionar_de')){
                $validate_de = [
                    'redirecionar_url_de' => 'required'
                ];
            }else{
                $validate_de = [
                    'title_de' => 'required',
                    'descricao_de' => 'required',
                    'twitterhashtags_de' => 'required',
                    'facebooktitulo_de' => 'required',
                    'facebookdescricao_de' => 'required'
                ];
            }
        }

        $validate_arr = array_merge($validate_comum, $validate_pt, $validate_es, $validate_it, $validate_en, $validate_fr, $validate_de);

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
                'slug'                 => $request->get('slug'), 
                'descricao'            => $request->get('descricao'),  
                'twitterhashtags'      => $request->get('twitterhashtags'),
                'facebooktitulo'       => $request->get('facebooktitulo'),
                'facebookdescricao'    => $request->get('facebookdescricao'),
            );

            $input_es = array(
                'ativo_es'             => $request->get('ativo_es'), 
                'redirecionar_es'      => $request->get('redirecionar_es'), 
                'redirecionar_url_es'  => $request->get('redirecionar_url_es'), 
                'title_es'             => $request->get('title_es'),
                'slug_es'              => $request->get('slug_es'),
                'descricao_es'         => $request->get('descricao_es'),  
                'twitterhashtags_es'   => $request->get('twitterhashtags_es'),
                'facebooktitulo_es'    => $request->get('facebooktitulo_es'),
                'facebookdescricao_es' => $request->get('facebookdescricao_es'),                
            );

            $input_it = array(         
                'ativo_it'             => $request->get('ativo_it'), 
                'redirecionar_it'      => $request->get('redirecionar_it'), 
                'redirecionar_url_it'  => $request->get('redirecionar_url_it'), 
                'title_it'             => $request->get('title_it'),
                'slug_it'              => $request->get('slug_it'), 
                'descricao_it'         => $request->get('descricao_it'),  
                'twitterhashtags_it'   => $request->get('twitterhashtags_it'),
                'facebooktitulo_it'    => $request->get('facebooktitulo_it'),
                'facebookdescricao_it' => $request->get('facebookdescricao_it'),                 
            );

            $input_en = array( 
                'ativo_en'             => $request->get('ativo_en'), 
                'redirecionar_en'      => $request->get('redirecionar_en'), 
                'redirecionar_url_en'  => $request->get('redirecionar_url_en'), 
                'title_en'             => $request->get('title_en'),
                'slug_en'              => $request->get('slug_en'), 
                'descricao_en'         => $request->get('descricao_en'),  
                'twitterhashtags_en'   => $request->get('twitterhashtags_en'),
                'facebooktitulo_en'    => $request->get('facebooktitulo_en'),
                'facebookdescricao_en' => $request->get('facebookdescricao_en'),                
            );

            $input_fr = array( 
                'ativo_fr'             => $request->get('ativo_fr'), 
                'redirecionar_fr'      => $request->get('redirecionar_fr'), 
                'redirecionar_url_fr'  => $request->get('redirecionar_url_fr'), 
                'title_fr'             => $request->get('title_fr'),
                'slug_fr'              => $request->get('slug_fr'), 
                'descricao_fr'         => $request->get('descricao_fr'),
                'twitterhashtags_fr'   => $request->get('twitterhashtags_fr'),
                'facebooktitulo_fr'    => $request->get('facebooktitulo_fr'),
                'facebookdescricao_fr' => $request->get('facebookdescricao_fr'),                
            );

            $input_de = array( 
                'ativo_de'             => $request->get('ativo_de'), 
                'redirecionar_de'      => $request->get('redirecionar_de'), 
                'redirecionar_url_de'  => $request->get('redirecionar_url_de'), 
                'title_de'             => $request->get('title_de'),
                'slug_de'              => $request->get('slug_de'), 
                'descricao_de'         => $request->get('descricao_de'),
                'twitterhashtags_de'   => $request->get('twitterhashtags_de'),
                'facebooktitulo_de'    => $request->get('facebooktitulo_de'),
                'facebookdescricao_de' => $request->get('facebookdescricao_de'),                
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
                'slug'                 => $request->get('slug'), 
                'descricao'            => $request->get('descricao'),  
                'twitterhashtags'      => $request->get('twitterhashtags'),
                'facebooktitulo'       => $request->get('facebooktitulo'),
                'facebookdescricao'    => $request->get('facebookdescricao'),                
            );

            $input_es = array(
                'ativo_es'             => $request->get('ativo_es'), 
                'redirecionar_es'      => $request->get('redirecionar_es'), 
                'redirecionar_url_es'  => $request->get('redirecionar_url_es'), 
                'title_es'             => $request->get('title_es'),
                'slug_es'              => $request->get('slug_es'), 
                'descricao_es'         => $request->get('descricao_es'),  
                'twitterhashtags_es'   => $request->get('twitterhashtags_es'),
                'facebooktitulo_es'    => $request->get('facebooktitulo_es'),
                'facebookdescricao_es' => $request->get('facebookdescricao_es'),                
            );         

            $input_it = array(
                'ativo_it'             => $request->get('ativo_it'), 
                'redirecionar_it'      => $request->get('redirecionar_it'), 
                'redirecionar_url_it'  => $request->get('redirecionar_url_it'), 
                'title_it'             => $request->get('title_it'),
                'slug_es'              => $request->get('slug_es'),
                'descricao_it'         => $request->get('descricao_it'), 
                'twitterhashtags_it'   => $request->get('twitterhashtags_it'),
                'facebooktitulo_it'    => $request->get('facebooktitulo_it'),
                'facebookdescricao_it' => $request->get('facebookdescricao_it'),                
            );

            $input_en = array(
                'ativo_en'             => $request->get('ativo_en'), 
                'redirecionar_en'      => $request->get('redirecionar_en'), 
                'redirecionar_url_en'  => $request->get('redirecionar_url_en'), 
                'title_en'             => $request->get('title_en'),
                'slug_en'              => $request->get('slug_en'), 
                'descricao_en'         => $request->get('descricao_en'), 
                'twitterhashtags_en'   => $request->get('twitterhashtags_en'),
                'facebooktitulo_en'    => $request->get('facebooktitulo_en'),
                'facebookdescricao_en' => $request->get('facebookdescricao_en'),                
            );

            $input_fr = array(
                'ativo_fr'             => $request->get('ativo_fr'), 
                'redirecionar_fr'      => $request->get('redirecionar_fr'), 
                'redirecionar_url_fr'  => $request->get('redirecionar_url_fr'), 
                'title_fr'             => $request->get('title_fr'),
                'slug_fr'              => $request->get('slug_fr'), 
                'descricao_fr'         => $request->get('descricao_fr'),  
                'twitterhashtags_fr'   => $request->get('twitterhashtags_fr'),
                'facebooktitulo_fr'    => $request->get('facebooktitulo_fr'),
                'facebookdescricao_fr' => $request->get('facebookdescricao_fr'),                
            );            

            $input_de = array(
                'ativo_de'             => $request->get('ativo_de'), 
                'redirecionar_de'      => $request->get('redirecionar_de'), 
                'redirecionar_url_de'  => $request->get('redirecionar_url_de'), 
                'title_de'             => $request->get('title_de'),
                'slug_de'              => $request->get('slug_de'), 
                'descricao_de'         => $request->get('descricao_de'),  
                'twitterhashtags_de'   => $request->get('twitterhashtags_de'),
                'facebooktitulo_de'    => $request->get('facebooktitulo_de'),
                'facebookdescricao_de' => $request->get('facebookdescricao_de'),                
            );            
        }

        Peticao::find($id)->update($input);
        Peticao::find($id)->update($input_es);
        Peticao::find($id)->update($input_it);
        Peticao::find($id)->update($input_en);
        Peticao::find($id)->update($input_fr);
        Peticao::find($id)->update($input_de);


        // PT-BR  ////////////////////////////////////////////////////////////////////////////////////////
        if($request->get('conteudo')=='' || $request->get('conteudo')==null){
            $conteudo_br = '.';
        }else{
            $conteudo_br = $request->get('conteudo');
        }

        if($request->get('peticao')=='' || $request->get('peticao')==null){
            $peticao_br = '.';
        }else{
            $peticao_br = $request->get('peticao');
        }

        $input2 = array(
            'conteudo' => $conteudo_br, 
            'peticao'  => $peticao_br,
        );

        DB::table('peticaos_conteudos')
            ->where([['peticao_id', '=', $id], ['idioma', '=', 'br'],])
            ->update($input2);

        // ES     ////////////////////////////////////////////////////////////////////////////////////////
        if($request->get('conteudo_es')=='' || $request->get('conteudo_es')==null){
            $conteudo_es = '.';
        }else{
            $conteudo_es = $request->get('conteudo_es');
        }

        if($request->get('peticao_es')=='' || $request->get('peticao_es')==null){
            $peticao_es = '.';
        }else{
            $peticao_es = $request->get('peticao_es');
        }

        $input2_es = array(
            'conteudo' => $conteudo_es, 
            'peticao'  => $peticao_es,
        );

        DB::table('peticaos_conteudos')
            ->where([['peticao_id', '=', $id], ['idioma', '=', 'es'],])
            ->update($input2_es);        

        // IT     ////////////////////////////////////////////////////////////////////////////////////////

        if($request->get('conteudo_it')=='' || $request->get('conteudo_it')==null){
            $conteudo_it = '.';
        }else{
            $conteudo_it = $request->get('conteudo_it');
        }

        if($request->get('peticao_it')=='' || $request->get('peticao_it')==null){
            $peticao_it = '.';
        }else{
            $peticao_it = $request->get('peticao_it');
        }

        $input2_it = array(
            'conteudo' => $conteudo_it, 
            'peticao'  => $peticao_it,
        );

        DB::table('peticaos_conteudos')
            ->where([['peticao_id', '=', $id], ['idioma', '=', 'it'],])
            ->update($input2_it); 

        // EN     ////////////////////////////////////////////////////////////////////////////////////////

        if($request->get('conteudo_en')=='' || $request->get('conteudo_en')==null){
            $conteudo_en = '.';
        }else{
            $conteudo_en = $request->get('conteudo_en');
        }

        if($request->get('peticao_en')=='' || $request->get('peticao_en')==null){
            $peticao_en = '.';
        }else{
            $peticao_en = $request->get('peticao_en');
        }

        $input2_en = array(
            'conteudo' => $conteudo_en, 
            'peticao'  => $peticao_en,
        );

        DB::table('peticaos_conteudos')
            ->where([['peticao_id', '=', $id], ['idioma', '=', 'en'],])
            ->update($input2_en);

        // FR     ////////////////////////////////////////////////////////////////////////////////////////

        if($request->get('conteudo_fr')=='' || $request->get('conteudo_fr')==null){
            $conteudo_fr = '.';
        }else{
            $conteudo_fr = $request->get('conteudo_fr');
        }

        if($request->get('peticao_fr')=='' || $request->get('peticao_fr')==null){
            $peticao_fr = '.';
        }else{
            $peticao_fr = $request->get('peticao_fr');
        }

        $input2_fr = array(
            'conteudo' => $conteudo_fr, 
            'peticao'  => $peticao_fr,
        );

        DB::table('peticaos_conteudos')
            ->where([['peticao_id', '=', $id], ['idioma', '=', 'fr'],])
            ->update($input2_fr);

        // DE     ////////////////////////////////////////////////////////////////////////////////////////

        if($request->get('conteudo_de')=='' || $request->get('conteudo_de')==null){
            $conteudo_de = '.';
        }else{
            $conteudo_de = $request->get('conteudo_de');
        }

        if($request->get('peticao_de')=='' || $request->get('peticao_de')==null){
            $peticao_de = '.';
        }else{
            $peticao_de = $request->get('peticao_de');
        }

        $input2_de = array(
            'conteudo' => $conteudo_de, 
            'peticao'  => $peticao_de,
        );

        DB::table('peticaos_conteudos')
            ->where([['peticao_id', '=', $id], ['idioma', '=', 'de'],])
            ->update($input2_de);

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

        DB::table('peticaos_conteudos')->where('peticao_id', '=', $id)->delete();

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function embed(Request $request, $slug)
    {
        $slug_idioma    = DB::table('peticaos')->where('slug', $slug)->first();
        $slug_idioma_es = DB::table('peticaos')->where('slug_es', $slug)->first();
        $slug_idioma_it = DB::table('peticaos')->where('slug_it', $slug)->first();
        $slug_idioma_en = DB::table('peticaos')->where('slug_en', $slug)->first();
        $slug_idioma_fr = DB::table('peticaos')->where('slug_fr', $slug)->first();
        $slug_idioma_de = DB::table('peticaos')->where('slug_de', $slug)->first();

        if($slug_idioma != null){
            $idioma = 'pt';
            $sqlpeticao = DB::table('peticaos')
                        ->select('id', 'slug', 'mostrar_progresso', 'objetivo', 'assinaturas_fisica', 'imagem', 'facebooktitulo', 'facebookdescricao')
                        ->where('slug', $slug)
                        ->first();

            $sqlconteudo = DB::table('peticaos_conteudos')
                        ->select('conteudo', 'peticao')
                        ->where([['peticao_id', '=', $sqlpeticao->id], ['idioma', '=', 'br'],])
                        ->first();

            $item = (object) array_merge((array)$sqlpeticao, (array)$sqlconteudo);

        }else if($slug_idioma_es != null){
            $idioma = 'es';
            $sqlpeticao   = DB::table('peticaos')
                        ->select('id', 'slug_es as slug','mostrar_progresso', 'objetivo', 'assinaturas_fisica', 'imagem', 'facebooktitulo_es as facebooktitulo', 'facebookdescricao_es as facebookdescricao')
                        ->where('slug_es', $slug)
                        ->first();

            $sqlconteudo = DB::table('peticaos_conteudos')
                        ->select('conteudo', 'peticao')
                        ->where([['peticao_id', '=', $sqlpeticao->id], ['idioma', '=', 'es'],])
                        ->first();

            $item = (object) array_merge((array)$sqlpeticao, (array)$sqlconteudo);
            
        }else if($slug_idioma_it != null){
            $idioma = 'it';
            $sqlpeticao   = DB::table('peticaos')
                        ->select('id', 'slug_it as slug','mostrar_progresso', 'objetivo', 'assinaturas_fisica', 'imagem', 'facebooktitulo_it as facebooktitulo', 'facebookdescricao_it as facebookdescricao')
                        ->where('slug_it', $slug)
                        ->first();

            $sqlconteudo = DB::table('peticaos_conteudos')
                        ->select('conteudo', 'peticao')
                        ->where([['peticao_id', '=', $sqlpeticao->id], ['idioma', '=', 'it'],])
                        ->first();

            $item = (object) array_merge((array)$sqlpeticao, (array)$sqlconteudo);

        }else if($slug_idioma_en != null){
            $idioma = 'en';
            $sqlpeticao   = DB::table('peticaos')
                        ->select('id', 'slug_en as slug', 'mostrar_progresso', 'objetivo', 'assinaturas_fisica', 'imagem', 'facebooktitulo_en as facebooktitulo', 'facebookdescricao_en as facebookdescricao')
                        ->where('slug_en', $slug)
                        ->first();

            $sqlconteudo = DB::table('peticaos_conteudos')
                        ->select('conteudo', 'peticao')
                        ->where([['peticao_id', '=', $sqlpeticao->id], ['idioma', '=', 'en'],])
                        ->first();

            $item = (object) array_merge((array)$sqlpeticao, (array)$sqlconteudo);

        }else if($slug_idioma_fr != null){
            $idioma = 'fr';
            $sqlpeticao   = DB::table('peticaos')
                        ->select('id', 'slug_fr as slug', 'mostrar_progresso', 'objetivo', 'assinaturas_fisica', 'imagem', 'facebooktitulo_fr as facebooktitulo', 'facebookdescricao_fr as facebookdescricao')
                        ->where('slug_fr', $slug)
                        ->first();

            $sqlconteudo = DB::table('peticaos_conteudos')
                        ->select('conteudo', 'peticao')
                        ->where([['peticao_id', '=', $sqlpeticao->id], ['idioma', '=', 'fr'],])
                        ->first();

            $item = (object) array_merge((array)$sqlpeticao, (array)$sqlconteudo);
        
        }else if($slug_idioma_de != null){
            $idioma = 'de';
            $sqlpeticao   = DB::table('peticaos')
                        ->select('id', 'slug_de as slug', 'mostrar_progresso', 'objetivo', 'assinaturas_fisica', 'imagem', 'facebooktitulo_de as facebooktitulo', 'facebookdescricao_de as facebookdescricao')
                        ->where('slug_de', $slug)
                        ->first();

            $sqlconteudo = DB::table('peticaos_conteudos')
                        ->select('conteudo', 'peticao')
                        ->where([['peticao_id', '=', $sqlpeticao->id], ['idioma', '=', 'de'],])
                        ->first();

            $item = (object) array_merge((array)$sqlpeticao, (array)$sqlconteudo);

        }

        $apoiantes  = DB::table('assinantes')->where('peticao_id', $item->id)->count();

        $apoiantes_porcetagem = ( ($item->assinaturas_fisica + $apoiantes) / $item->objetivo ) * 100;
        $item2 = array('apoiantes' => $apoiantes, 'valuenow' => $apoiantes_porcetagem);

        return view('peticaos.embed', compact('item', 'item2'));

    }    

}
