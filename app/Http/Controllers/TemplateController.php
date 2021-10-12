<?php

namespace App;

use App\Http\Controllers\Controller;
use App\Models\Template;
use Illuminate\Http\Request;


class TemplateController extends Controller
{
    public function index()
    {

        $templates = Template::all();


        return view('templates.index', ['templates' => $templates]);
    }

    public function show(Template $template)
    {

        $templates = Template::all();

        return view('templates.show', ['template' => $template]);
    }

    public function edit(Template $template)
    {

        return view('templates.edit', ['template' => $template]);
    }

    public static function destroy(Template $template)
    {
        $template = Template::find($template->id)->delete();

        $templates = Template::all();

        return redirect()->route('templates.index');
    }

    public function store(Request $request)
    {

        $this->validate($request, array(
            //'title' => 'required|max:100|min:5',

        'title' => 'required|max:100|min:5', 
        'body' => 'required|max:100|min:5', 


        ));
        $template = new Template();


       // $template->title = $request->input("title"); //THIS
                $template->title = $request->title; 
        $template->body = $request->body; 


        $template->save();
        return redirect()->back()->with("success", "Created New Template!");
    }

    public function update(Request $request, Template $template)
    {
        $this->validate($request, array(

        'title' => 'required|max:100|min:5', 
        'body' => 'required|max:100|min:5', 

        ));

        $template->title = $request->title; 
        $template->body = $request->body; 


        $template->save();

        return view('templates.show', ['template' => $template])->withSuccess("Edited");

    }

}
