<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class EmailController extends Controller
{
    public function send(Request $request){
    
        #$share_mail_nome       = $request->input('share_mail_nome');
        #$share_mail_amigo_nome = $request->input('share_mail_amigo');
        #$share_mail_amigo_mail = $request->input('share_mail_amigo_mail');
        #$share_mail_amigo_mail = $request->input('share_mail_mensagem');

        /*
        Mail::send('peticaos.send', ['share_mail_nome' => $share_mail_nome, 'share_mail_amigo_nome' => $share_mail_amigo_nome, 'share_mail_amigo_mail' => $share_mail_amigo_mail, 'share_mail_mensagem' => $share_mail_mensagem], function ($message)
        {
            $message->from('me@gmail.com', 'Christian Nwamba');
            $message->to('edyfreela@gmail.com');
        });

        return response()->json(['message' => 'Request completed']);
        */

        return 'ok';
	}
}
