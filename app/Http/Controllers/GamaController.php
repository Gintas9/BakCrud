<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Gama;
use Illuminate\Http\Request;


class GamaController extends Controller
{
    public function index()
    {

        $gamas = Gama::all();


        return view('gamas.index', ['gamas' => $gamas]);
    }

    public function show(Gama $gama)
    {

        $gamas = Gama::all();

        return view('gamas.show', ['gama' => $gama]);
    }

    public function edit(Gama $gama)
    {

        return view('gamas.edit', ['gama' => $gama]);
    }

    public static function destroy(Gama $gama)
    {
        $gama = Gama::find($gama->id)->delete();

        $gamas = Gama::all();

        return redirect()->route('gamas.index');
    }

    public function store(Request $request)
    {

        $this->validate($request, array(
            //'title' => 'required|max:100|min:5',

        'title' => 'required|max:100|min:5', 
        'body' => 'required|max:100|min:5', 
        'age' => 'required|max:100|min:5', 


        ));
        $gama = new Gama();


       // $gama->title = $request->input("title"); //THIS
                $gama->title = $request->title; 
        $gama->body = $request->body; 
        $gama->age = $request->age; 


        $gama->save();
        return redirect()->back()->with("success", "Created New Gama!");
    }

    public function update(Request $request, Gama $gama)
    {
        $this->validate($request, array(

        'title' => 'required|max:100|min:5', 
        'body' => 'required|max:100|min:5', 
        'age' => 'required|max:100|min:5', 

        ));

        $gama->title = $request->title; 
        $gama->body = $request->body; 
        $gama->age = $request->age; 


        $gama->save();

        return view('gamas.show', ['gama' => $gama])->withSuccess("Edited");

    }

}
