<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class ProfileController extends Controller
{
    public function edit($id)
    {
        $item = User::find($id);
        $item2 = $item->avatar;

        if($item2==null || $item2=''){
        	$item2 = env('APP_URL').'/'.env('IMAGEM_USER_PATH').'/'.env('IMAGEM_USER_DEFAULT');
        }else{
        	$item2 = env('APP_URL').'/'.env('IMAGEM_USER_PATH').'/'.$item->avatar;
        }

        return view('profile.edit',compact('item', 'item2'));
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

    	if($request->passw != null || $request->passw != ''){
	    	$this->validate($request, [
		        'name' => 'required|max:255',
		        'passw' => 'required|min:6',
		        'passw_confirmation' => 'required|min:6|same:passw'
		    ]);
    	}else{
	    	$this->validate($request, [
		        'name' => 'required|max:255'
		    ]);
    	}

    	$file = $request->file('avatar');

    	if($file!=null || $file!=''){
    		
    		$file->move(env('IMAGEM_USER_PATH'), $file->getClientOriginalName());

	        $user = User::find($id);
	        
            if($user->avatar!=null){
	            
                $path_img_saved = public_path(env('IMAGEM_USER_PATH').DIRECTORY_SEPARATOR.$user->avatar);

                if (file_exists($path_img_saved))
    	        {
    	            unlink($path_img_saved);
    	        }
            }

            if($request->passw != null || $request->passw != ''){
    	        $input = array(
    	            'name'     => $request->get('name'), 
    	            'password' => bcrypt($request->get('passw')),
    	        	'avatar'   => $file->getClientOriginalName()
    	        );
            }else{
                $input = array(
                    'name'     => $request->get('name'),
                    'avatar'   => $file->getClientOriginalName()
                );
            }

    	}else{
    		
            if($request->passw != null || $request->passw != ''){
                $input = array(
                    'name'     => $request->get('name'), 
                    'password' => bcrypt($request->get('passw'))
                );
            }else{
                $input = array(
                    'name'     => $request->get('name')
                );
            }
    	}

        User::find($id)->update($input);

        return redirect()->route('profile.edit', $id)
                        ->with('success','Usuário atualizado com sucesso');
    }
}
