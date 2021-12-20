<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Gamma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GammaController extends Controller
{
    public function index()
    {

        $gammas = Gamma::all();
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }

        return view('gammas.index', ['gammas' => $gammas]);
    }

    public function show(Gamma $gamma)
    {
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }
        $gammas = Gamma::all();

        return view('gammas.show', ['gamma' => $gamma]);
    }

    public function edit(Gamma $gamma)
    {
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }
        return view('gammas.edit', ['gamma' => $gamma]);
    }

    public static function destroy(Gamma $gamma)
    {
         if(!Auth::check()){


                return redirect("login")->withSuccess('You are not allowed to access');
            }
        $gamma = Gamma::find($gamma->id)->delete();

        $gammas = Gamma::all();

        return redirect()->route('gammas.index');
    }

    public function store(Request $request)
    {
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }

        $this->validate($request, array(
            //'title' => 'required|max:100|min:5',

        'filePath' => 'required', 


        ));
        $gamma = new Gamma();


       // $gamma->title = $request->input("title"); //THIS
               if($request->filePath != null) { 
        $url = $request->file("filePath")->store("public");
           $url=str_replace("public/","",$url);
           $gamma->filePath  = $url;}  

        $gamma->save();
        return redirect()->back()->with("success", "Created New Gamma!");
    }

    public function update(Request $request, Gamma $gamma)
    {
         if(!Auth::check()){


                return redirect("login")->withSuccess('You are not allowed to access');
            }
        $this->validate($request, array(

        'filePath' => 'required', 

        ));

       if($request->filePath != null) { 
        $url = $request->file("filePath")->store("public");
           $url=str_replace("public/","",$url);
           $gamma->filePath  = $url;}  

        $gamma->save();

        return view('gammas.show', ['gamma' => $gamma])->withSuccess("Edited");

    }

}
