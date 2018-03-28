<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Redirect;
use App\Http\Requests;
use DB;

class LanguageController extends Controller
{
    public function index(Request $request){
 
    	$language       = $request->get('language');
    	session(['locale' => $language]);

		$url_prev       = url()->previous();
		$url_prev_parse = parse_url($url_prev);
		$slug_origem    = ltrim($url_prev_parse['path'], "/");

		if($language=='pt-br'){

	        $slug = DB::table('peticaos')
	                	->select('slug')
	                    ->where('slug', '=', $slug_origem)
	                    ->orwhere('slug_es', '=', $slug_origem)
	                    ->orwhere('slug_it', '=', $slug_origem)
	                    ->orwhere('slug_en', '=', $slug_origem)
	                    ->orwhere('slug_fr', '=', $slug_origem)
	                    ->first();

	        if($slug!=null){
	        	return redirect( url('/').'/'.$slug->slug );
	        }else{
	        	return redirect( url('/') );
	        }

		}else if($language=='es'){
	       
	        $slug = DB::table('peticaos')
	                	->select('slug_es', 'redirecionar_es', 'redirecionar_url_es')
	                    ->where('slug', '=', $slug_origem)
	                    ->orwhere('slug_es', '=', $slug_origem)
	                    ->orwhere('slug_it', '=', $slug_origem)
	                    ->orwhere('slug_en', '=', $slug_origem)
	                    ->orwhere('slug_fr', '=', $slug_origem)
	                    ->first();
            
	        if($slug!=null){
	            if($slug->redirecionar_es=='y'){
	                return redirect($slug->redirecionar_url_es);
	            }else{
	        		return redirect( url('/').'/'.$slug->slug_es );
	            }	        	
	        }else{
	        	return redirect( url('/') );
	        }

		}else if($language=='it'){
	        
	        $slug = DB::table('peticaos')
	                	->select('slug_it', 'redirecionar_it', 'redirecionar_url_it')
	                    ->where('slug', '=', $slug_origem)
	                    ->orwhere('slug_es', '=', $slug_origem)
	                    ->orwhere('slug_it', '=', $slug_origem)
	                    ->orwhere('slug_en', '=', $slug_origem)
	                    ->orwhere('slug_fr', '=', $slug_origem)
	                    ->first();

	        
	        if($slug!=null){
	            if($slug->redirecionar_it=='y'){
	                return redirect($slug->redirecionar_url_it);
	            }else{
	        		return redirect( url('/').'/'.$slug->slug_it );
	            }
	        }else{
	        	return redirect( url('/') );
	        }

		}else if($language=='en'){
	        
	        $slug = DB::table('peticaos')
	                	->select('slug_en', 'redirecionar_en', 'redirecionar_url_en')
	                    ->where('slug', '=', $slug_origem)
	                    ->orwhere('slug_es', '=', $slug_origem)
	                    ->orwhere('slug_it', '=', $slug_origem)
	                    ->orwhere('slug_en', '=', $slug_origem)
	                    ->orwhere('slug_fr', '=', $slug_origem)
	                    ->first();


	        if($slug!=null){
	            if($slug->redirecionar_en=='y'){
	                return redirect($slug->redirecionar_url_en);
	            }else{
	        		return redirect( url('/').'/'.$slug->slug_en );
	            }
	        }else{
	        	return redirect( url('/') );
	        }

		}else if($language=='fr'){
	        
	        $slug = DB::table('peticaos')
	                	->select('slug_fr', 'redirecionar_fr', 'redirecionar_url_fr')
	                    ->where('slug', '=', $slug_origem)
	                    ->orwhere('slug_es', '=', $slug_origem)
	                    ->orwhere('slug_it', '=', $slug_origem)
	                    ->orwhere('slug_en', '=', $slug_origem)
	                    ->orwhere('slug_fr', '=', $slug_origem)
	                    ->first();


	        if($slug!=null){
	            if($slug->redirecionar_fr=='y'){
	                return redirect($slug->redirecionar_url_fr);
	            }else{
	        		return redirect( url('/').'/'.$slug->slug_fr );
	            }
	        }else{
	        	return redirect( url('/') );
	        }

		}else{
			return redirect( url('/') );
		}
   	
    }
}
