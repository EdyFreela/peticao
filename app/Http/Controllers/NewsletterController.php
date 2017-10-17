<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Newsletter;

class NewsletterController extends Controller
{
    /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function index(Request $request)
    {
        $items = Newsletter::orderBy('id','DESC')->paginate(5);

        return view('newsletters.index',compact('items'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
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
            'email' => 'required|email|max:255|unique:newsletters'
        ]);

        $input = new Newsletter(array(
            'email' => $request->get('email')
        ));

        $input->save();

        return redirect()->route('welcome.index', ['#email'])
                        ->with('newsletter','Cadastrado com Sucesso');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Newsletter::find($id);        

        Newsletter::find($id)->delete();
        return redirect()->route('newsletters.index');
    }

}
