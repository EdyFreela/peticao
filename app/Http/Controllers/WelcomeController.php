<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Peticao;
use App;
use Illuminate\Support\Facades\Session;

class WelcomeController extends Controller
{
    /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function index(Request $request)
    {

        if(session('locale')==null){
            $locale = App::getLocale();
            App::setLocale($locale);
        }else{
            App::setLocale(session('locale'));
        }

        if(App::getLocale()=='pt-br'){
            $items = Peticao::orderBy('created_at','DESC')
                        ->select('title', 'slug', 'descricao', 'imagem')
                        ->limit(5)
                        ->get();
            $items2 = Peticao::orderBy('created_at','DESC')
                        ->select('title', 'slug', 'imagem')
                        ->limit(3)
                        ->get();                        
        }else if(App::getLocale()=='es'){
            $items = Peticao::orderBy('created_at','DESC')
                        ->select('title_es as title', 'slug_es as slug', 'descricao_es as descricao', 'imagem')
                        ->limit(5)
                        ->get();
            $items2 = Peticao::orderBy('created_at','DESC')
                        ->select('title_es as title', 'slug_es as slug', 'imagem')
                        ->limit(3)
                        ->get();                        
        }else if(App::getLocale()=='it'){
            $items = Peticao::orderBy('created_at','DESC')
                        ->select('title_it as title', 'slug_it as slug', 'descricao_it as descricao', 'imagem')
                        ->limit(5)
                        ->get();
            $items2 = Peticao::orderBy('created_at','DESC')
                        ->select('title_it as title', 'slug_it as slug', 'imagem')
                        ->limit(3)
                        ->get();                        
        }else if(App::getLocale()=='en'){
            $items = Peticao::orderBy('created_at','DESC')
                        ->select('title_en as title', 'slug_en as slug', 'descricao_en as descricao', 'imagem')
                        ->limit(5)
                        ->get();
            $items2 = Peticao::orderBy('created_at','DESC')
                        ->select('title_en as title', 'slug_en as slug', 'imagem')
                        ->limit(3)
                        ->get();                        
        }

        return view('welcome', compact('items', 'items2'));
    }

}