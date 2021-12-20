<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Download;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class DownloadController extends Controller
{
    public function index()
    {

        $downloads = Download::all();


        return view('downloads.index', ['downloads' => $downloads]);
    }

    public function show(Download $download)
    {

        $downloads = Download::all();

        return view('downloads.show', ['download' => $download]);
    }

    public static function dLoad($id)
    {



       // return response()->download(storage_path("app/files/mtIqpQ4R0mpoBrrBq2LoRA2PuSRpCkx0ntRz7nCw.txt"),"mtIqpQ4R0mpoBrrBq2LoRA2PuSRpCkx0ntRz7nCw.txt");
       return Storage::download(storage_path("/app/public/main.py"),"main.py");
    }

    public function edit(Download $download)
    {

        return view('downloads.edit', ['download' => $download]);
    }

    public static function destroy(Download $download)
    {
        $download = Download::find($download->id)->delete();

        $downloads = Download::all();

        return redirect()->route('downloads.index');
    }

    public function store(Request $request)
    {

        $this->validate($request, array(
            //'title' => 'required|max:100|min:5',

        '' => 'required|max:100|min:5', 


        ));
        $download = new Download();


       // $download->title = $request->input("title"); //THIS



        $download->save();
        return redirect()->back()->with("success", "Created New Download!");
    }

    public function update(Request $request, Download $download)
    {
        $this->validate($request, array(

        '' => 'required|max:100|min:5', 

        ));




        $download->save();

        return view('downloads.show', ['download' => $download])->withSuccess("Edited");

    }

}
