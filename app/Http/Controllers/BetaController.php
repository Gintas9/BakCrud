<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Beta;
use Illuminate\Http\Request;


class BetaController extends Controller
{
    public function index()
    {

        $betas = Beta::all();


        return view('betas.index', ['betas' => $betas]);
    }

    public function show(Beta $beta)
    {

        $betas = Beta::all();

        return view('betas.show', ['beta' => $beta]);
    }

    public function edit(Beta $beta)
    {

        return view('betas.edit', ['beta' => $beta]);
    }

    public static function destroy(Beta $beta)
    {
        $beta = Beta::find($beta->id)->delete();

        $betas = Beta::all();

        return redirect()->route('betas.index');
    }

    public function store(Request $request)
    {

        $this->validate($request, array(
            //'title' => 'required|max:100|min:5',

        'title' => 'required|max:100|min:5', 
        'body' => 'required|max:100|min:5', 


        ));
        $beta = new Beta();


       // $beta->title = $request->input("title"); //THIS
                $beta->title = $request->title; 
        $beta->body = $request->body; 


        $beta->save();
        return redirect()->back()->with("success", "Created New Beta!");
    }

    public function update(Request $request, Beta $beta)
    {
        $this->validate($request, array(

        'title' => 'required|max:100|min:5', 
        'body' => 'required|max:100|min:5', 

        ));

        $beta->title = $request->title; 
        $beta->body = $request->body; 


        $beta->save();

        return view('betas.show', ['beta' => $beta])->withSuccess("Edited");

    }

}
