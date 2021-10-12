<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Temp;
use Illuminate\Http\Request;


class TempController extends Controller
{
    public function index()
    {

        $temps = Temp::all();


        return view('temps.index', ['temps' => $temps]);
    }

    public function show(Temp $temp)
    {

        $temps = Temp::all();

        return view('temps.show', ['temp' => $temp]);
    }

    public function edit(Temp $temp)
    {

        return view('temps.edit', ['temp' => $temp]);
    }

    public static function destroy(Temp $temp)
    {
        $temp = Temp::find($temp->id)->delete();

        $temps = Temp::all();

        return redirect()->route('temps.index');
    }

    public function store(Request $request)
    {

        $this->validate($request, array(
            //'title' => 'required|max:100|min:5',

            'title' => 'required|max:100|min:5',
            'body' => 'required|max:100|min:5',


        ));
        $temp = new Temp();


        // $temp->title = $request->input("title"); //THIS
        $temp->title = $request->title;
        $temp->body = $request->body;


        $temp->save();
        return redirect()->back()->with("success", "Created New Temp!");
    }

    public function update(Request $request, Temp $temp)
    {
        $this->validate($request, array(

            'title' => 'required|max:100|min:5',
            'body' => 'required|max:100|min:5',

        ));

        $temp->title = $request->title;
        $temp->body = $request->body;


        $temp->save();

        return view('temps.show', ['temp' => $temp])->withSuccess("Edited");

    }

}
