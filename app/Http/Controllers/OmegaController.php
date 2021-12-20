<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Omega;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OmegaController extends Controller
{
    public function index()
    {

        $omegas = Omega::all();
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }

        return view('omegas.index', ['omegas' => $omegas]);
    }

    public function show(Omega $omega)
    {
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }
        $omegas = Omega::all();

        return view('omegas.show', ['omega' => $omega]);
    }

    public function edit(Omega $omega)
    {
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }
        return view('omegas.edit', ['omega' => $omega]);
    }

    public static function destroy(Omega $omega)
    {
         if(!Auth::check()){


                return redirect("login")->withSuccess('You are not allowed to access');
            }
        $omega = Omega::find($omega->id)->delete();

        $omegas = Omega::all();

        return redirect()->route('omegas.index');
    }

    public function store(Request $request)
    {
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }

        $this->validate($request, array(
            //'title' => 'required|max:100|min:5',

        'name' => 'required|max:100', 
        'lastName' => 'required', 
        'filePath' => 'min:1', 


        ));
        $omega = new Omega();


       // $omega->title = $request->input("title"); //THIS
                $omega->name = $request->name; 
        $omega->lastName = $request->lastName; 
       if($request->filePath != null) { 
        $url = $request->file("filePath")->store("public");
           $url=str_replace("public/","",$url);
           $omega->filePath  = $url;}  

        $omega->save();
        return redirect()->back()->with("success", "Created New Omega!");
    }

    public function update(Request $request, Omega $omega)
    {
         if(!Auth::check()){


                return redirect("login")->withSuccess('You are not allowed to access');
            }
        $this->validate($request, array(

        'name' => 'required|max:100', 
        'lastName' => 'required', 
        'filePath' => 'min:1', 

        ));

        $omega->name = $request->name; 
        $omega->lastName = $request->lastName; 
       if($request->filePath != null) { 
        $url = $request->file("filePath")->store("public");
           $url=str_replace("public/","",$url);
           $omega->filePath  = $url;}  

        $omega->save();

        return view('omegas.show', ['omega' => $omega])->withSuccess("Edited");

    }

}
