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

class AssinanteController extends Controller
{
    /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function index(Request $request)
    {
        $items = User::orderBy('name','ASC')->where('admin', '!=', '1')->paginate(10);

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
        return view('assinantes.create');
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        $input = new User(array(
            'name'      => $request->get('name'), 
            'email'     => $request->get('email'), 
            'password'  => bcrypt($request->get('password')), 
            'admin'     => '0', 
            'activated' => '1'
        ));

        $input->save();

        return redirect()->route('assinantes.index')
                        ->with('success','Usuário criado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $item       = DB::table('users')
                            ->where('id', $id)
                            ->get();

        return view('assinantes.show',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = User::find($id);

        return view('assinantes.edit',compact('item'));
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

        if($request->get('password')==null || $request->get('password')==''){
            $this->validate($request, [
                'name' => 'required|max:255'
            ]);

            $input = array(
                'name'     => $request->get('name')
            );

        }else{
            $this->validate($request, [
                'name' => 'required|max:255',
                'password' => 'required|min:6|confirmed'
            ]);            

            $input = array(
                'name'     => $request->get('name'), 
                'password' => $request->get('password')
            );
        }

        User::find($id)->update($input);

        return redirect()->route('assinantes.index')
                        ->with('success','Assinante atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        User::find($id)->delete();
        return redirect()->route('peticaos.index')
                        ->with('success','Assinante deletado com sucesso');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function assinar(Request $request)
    {
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

        if($votou<1){
            $input->save();
            Session::flash('message', '<h2><strong>OBRIGADO!</strong> São pessoas como você que estão fazendo a diferença.</h2><h2>Você assinou <strong>'.$item->title.'</strong></h2>');
            return view('thanks', compact('item', 'input'));
        }else{
            Session::flash('message', '<h2>Obrigado por não ser omisso ou acomodado!</h2><h2>Felizmente, você já assinou essa petição!</h2>');
            return view('thanks', compact('item', 'input'));
        }
    }
}