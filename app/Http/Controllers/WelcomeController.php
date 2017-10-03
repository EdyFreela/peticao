<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Peticao;

class WelcomeController extends Controller
{
    /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function index(Request $request)
    {

        $items = Peticao::orderBy('created_at','ASC')
                    ->get();

        return view('welcome', compact('items'));
    }

}