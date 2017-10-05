<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


class PgController extends Controller
{
    /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function privacy(Request $request)
    {
        return view('pg.privacy');
    }

    /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function terms(Request $request)
    {
        return view('pg.terms');
    }

}
