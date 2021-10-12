<?php

namespace App;

use App\Http\Controllers\Controller;
use App\Models\Tempasa;
use Illuminate\Http\Request;


class TempasaController extends Controller
{
    public function index()
    {

        $tempasas = Tempasa::all();


        return view('tempasas.index', ['tempasas' => $tempasas]);
    }

    public function show(Tempasa $tempasa)
    {

        $tempasas = Tempasa::all();

        return view('tempasas.show', ['tempasa' => $tempasa]);
    }

    public function edit(Tempasa $tempasa)
    {

        return view('tempasas.edit', ['tempasa' => $tempasa]);
    }

    public static function destroy(Tempasa $tempasa)
    {
        $tempasa = Tempasa::find($tempasa->id)->delete();

        $tempasas = Tempasa::all();

        return redirect()->route('tempasas.index');
    }

    public function store(Request $request)
    {

        $this->validate($request, array(
            //'title' => 'required|max:100|min:5',

        'title' => 'required|max:100|min:5', 
        'body' => 'required|max:100|min:5', 


        ));
        $tempasa = new Tempasa();


       // $tempasa->title = $request->input("title"); //THIS
                $tempasa->title = $request->title; 
        $tempasa->body = $request->body; 


        $tempasa->save();
        return redirect()->back()->with("success", "Created New Tempasa!");
    }

    public function update(Request $request, Tempasa $tempasa)
    {
        $this->validate($request, array(

        'title' => 'required|max:100|min:5', 
        'body' => 'required|max:100|min:5', 

        ));

        $tempasa->title = $request->title; 
        $tempasa->body = $request->body; 


        $tempasa->save();

        return view('tempasas.show', ['tempasa' => $tempasa])->withSuccess("Edited");

    }

}
