<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Peticao;
use App\Assinante;
use App\User;
use DB;
use Session;
use Mail;
use App;

class AssinanteController extends Controller
{
    /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function index(Request $request)
    {
        $items = Assinante::orderBy('nome','ASC')
                    ->groupBy('email')
                    ->paginate(10);

        return view('assinantes.index',compact('items'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function create()
    {
        $items = DB::table('peticaos')->lists('title', 'id');

        return view('assinantes.create', compact('items'));
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
            'nome' => 'required|max:255',
            'sobrenome' => 'required|max:255',
            'email' => 'required|email|max:255|unique_with:assinantes,email,peticao_id'
        ]);

        $input = new Assinante(array(
            'peticao_id' => $request->get('peticao_id'), 
            'nome'       => $request->get('nome'), 
            'sobrenome'  => $request->get('sobrenome'), 
            'email'      => $request->get('email'), 
            'cidade'     => $request->get('cidade'), 
            'estado'     => $request->get('estado')
        ));

        $input->save();

        return redirect()->route('assinantes.index')
                        ->with('success','Assinatura criada com sucesso');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $items = DB::table('assinantes')
                    ->select('assinantes.id', 'peticaos.title', 'assinantes.created_at')
                    ->where('email', $id)
                    ->leftJoin('peticaos', 'peticaos.id', '=', 'assinantes.peticao_id')
                    ->get();

        return view('assinantes.edit',compact('items'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(filter_var($id, FILTER_VALIDATE_EMAIL)) {
            // Excluir Assinante
            Assinante::where('email', $id)->delete();
            return redirect()->route('assinantes.index')
                            ->with('success','Assinante deletado com sucesso'); 
        }
        else {
            // Excluir Assinatura
            Assinante::find($id)->delete();
            return redirect()->route('assinantes.index')
                            ->with('success','Assinatura deletada com sucesso');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function assinar(Request $request)
    {

        if(session('locale')==null){
            $locale = App::getLocale();
            App::setLocale($locale);
        }else{
            App::setLocale(session('locale'));
        }

        $id = $request->get('peticao_id');

        $item = Peticao::find($id);

        $input = new Assinante(array(
            'peticao_id'  => $id,
            'nome'        => $request->get('nome'),
            'sobrenome'   => $request->get('sobrenome'),
            'email'       => $request->get('email'),
            'cidade'      => $request->get('cidade'),
            'estado'      => $request->get('estado')
        ));

        $votou = DB::table('assinantes')->where([
            ['peticao_id', '=', $id],
            ['email', '=', $request->get('email')],
        ])->count();

        $nome      = $request->get('nome').' '.$request->get('sobrenome');
        $titulo    = $item->title;
        $link      = url($item->slug);
        $mailTo    = $request->get('email');

        if($votou<1){
            $input->save();

            Mail::send('emails.thanks', ['nome' => $nome, 'titulo' => $titulo, 'link' => $link], function ($message) use ($mailTo) {
                $mailFrom = DB::table('configuracaos')
                                ->where([
                                    ['type', '=', 'mail'],
                                    ['name', '=', 'username'],
                                ])->value('value');
                $message->from($mailFrom, 'Campanhas IPCO.org.br');
                $message->to($mailTo);
                $message->subject('Obrigado por assinar!');
            });

            Session::flash('message', "<h2><strong>@lang('words.assinar_msg_1')</strong> @lang('words.assinar_msg_2')</h2><h2>@lang('words.assinar_msg_3') <strong>".$item->title."</strong></h2>");
            return view('thanks', compact('item', 'input'));
        }else{
            Session::flash('message', "<h2>".trans('words.assinar_msg_4')."</h2><h2>".trans('words.assinar_msg_5')."</h2>");
            return view('thanks', compact('item', 'input'));
        }
    }
}