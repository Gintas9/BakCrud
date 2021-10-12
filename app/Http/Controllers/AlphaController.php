<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Alpha;
use Illuminate\Http\Request;


class AlphaController extends Controller
{
    public function index()
    {

        $alphas = Alpha::all();


        return view('alphas.index', ['alphas' => $alphas]);
    }

    public function show(Alpha $alpha)
    {

        $alphas = Alpha::all();

        return view('alphas.show', ['alpha' => $alpha]);
    }

    public function edit(Alpha $alpha)
    {

        return view('alphas.edit', ['alpha' => $alpha]);
    }

    public static function destroy(Alpha $alpha)
    {
        $alpha = Alpha::find($alpha->id)->delete();

        $alphas = Alpha::all();

        return redirect()->route('alphas.index');
    }

    public function store(Request $request)
    {

        $this->validate($request, array(
            //'title' => 'required|max:100|min:5',

        'title' => 'required|max:100|min:5', 
        'body' => 'required|max:100|min:5', 


        ));
        $alpha = new Alpha();



                $alpha->title = $request->title; 
        $alpha->body = $request->body; 


        $alpha->save();
        return redirect()->back()->with("success", "Created New Alpha!");
    }

    public function update(Request $request, Alpha $alpha)
    {
        $this->validate($request, array(

        'title' => 'required|max:100',
        'body' => 'required|max:100',

        ));

        $alpha->title = $request->title; 
        $alpha->body = $request->body;


        $alpha->save();

        return view('alphas.show', ['alpha' => $alpha])->withSuccess("Edited");

    }

}
