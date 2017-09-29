<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Peticao;
use App\Assinante;
use DB;

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
                    ->leftJoin('assinantes', 'peticaos.id', '=', 'assinantes.peticao_id')
                    ->selectRaw('peticaos.*, count(assinantes.peticao_id) as total')
                    ->groupBy('assinantes.peticao_id')
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

        $this->validate($request, [
            'title' => 'required',
            'conteudo' => 'required',
            'peticao' => 'required',
            'conteudomail' => 'required',
            'mailpeticao' => 'required',
            'objetivo' => 'required',
            'twitterhashtags' => 'required'
        ]);

        $file = $request->file('imagem');

        $file->move(env('IMAGEM_PETICAO_PATH'), $file->getClientOriginalName());

        #$input = $request->all();
        
        #$item = Peticao::create($input);

        $input = new Peticao(array(
            'title'           => $request->get('title'), 
            'conteudo'        => $request->get('conteudo'), 
            'peticao'         => $request->get('peticao'), 
            'conteudomail'    => $request->get('conteudomail'), 
            'mailpeticao'     => $request->get('mailpeticao'), 
            'imagem'          => $file->getClientOriginalName(), 
            'objetivo'        => $request->get('objetivo'),
            'twitterhashtags' => $request->get('twitterhashtags')
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
        $item       = DB::table('peticaos')->where('slug', $slug)->first();
        $apoiantes  = DB::table('assinantes')->where('peticao_id', $item->id)->count();

        $apoiantes_porcetagem = ( $apoiantes / $item->objetivo ) * 100;
        $item2 = array('apoiantes' => $apoiantes, 'valuenow' => $apoiantes_porcetagem);

        $comentarios  = DB::table('comentarios')
                            ->select('comentarios.comentario', 'comentarios.created_at', 'users.name')
                            ->where('peticao_id', $item->id)
                            ->leftJoin('users', 'users.id', '=', 'comentarios.user_id')
                            ->orderBy('comentarios.created_at', 'desc')
                            ->paginate(5);

        return view('peticaos.show',compact('item', 'item2', 'comentarios'))->with('i', ($request->input('page', 1) - 1) * 5);
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

        $this->validate($request, [
            'title' => 'required',
            'conteudo' => 'required',
            'peticao' => 'required',
            'conteudomail' => 'required',
            'mailpeticao' => 'required',
            'objetivo' => 'required',
            'twitterhashtags' => 'required'
        ]);

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
                'title'           => $request->get('title'), 
                'conteudo'        => $request->get('conteudo'),
                'peticao'         => $request->get('peticao'), 
                'conteudomail'    => $request->get('conteudomail'), 
                'mailpeticao'     => $request->get('mailpeticao'),                 
                'objetivo'        => $request->get('objetivo'),
                'twitterhashtags' => $request->get('twitterhashtags')
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
                'title'           => $request->get('title'), 
                'conteudo'        => $request->get('conteudo'), 
                'imagem'          => $file->getClientOriginalName(), 
                'peticao'         => $request->get('peticao'), 
                'conteudomail'    => $request->get('conteudomail'), 
                'mailpeticao'     => $request->get('mailpeticao'),                 
                'objetivo'        => $request->get('objetivo'),
                'twitterhashtags' => $request->get('twitterhashtags')
            );
        }

        Peticao::find($id)->update($input);

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

}
