<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Test;
use Illuminate\Http\Request;


class TestController extends Controller
{
    public function index()
    {

        $tests = Test::all();


        return view('tests.index', ['tests' => $tests]);
    }

    public function show(Test $test)
    {

        $tests = Test::all();

        return view('tests.show', ['test' => $test]);
    }

    public function edit(Test $test)
    {

        return view('tests.edit', ['test' => $test]);
    }

    public static function destroy(Test $test)
    {
        $test = Test::find($test->id)->delete();

        $tests = Test::all();

        return redirect()->route('tests.index');
    }

    public function store(Request $request)
    {

        $this->validate($request, array(
            //'title' => 'required|max:100|min:5',

        'title' => 'required|max:100|min:5', 
        'body' => 'required|max:100|min:5', 


        ));
        $test = new Test();


       // $test->title = $request->input("title"); //THIS
                $test->title = $request->title; 
        $test->body = $request->body; 


        $test->save();
        return redirect()->back()->with("success", "Created New Test!");
    }

    public function update(Request $request, Test $test)
    {
        $this->validate($request, array(

        'title' => 'required|max:100|min:5', 
        'body' => 'required|max:100|min:5', 

        ));

        $test->title = $request->title; 
        $test->body = $request->body; 


        $test->save();

        return view('tests.show', ['test' => $test])->withSuccess("Edited");

    }

}
