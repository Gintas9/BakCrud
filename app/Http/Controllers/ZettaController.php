<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Zetta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ZettaController extends Controller
{
    public function index()
    {

        $zettas = Zetta::all();
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }

        return view('zettas.index', ['zettas' => $zettas]);
    }

    public function show(Zetta $zetta)
    {
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }
        $zettas = Zetta::all();

        return view('zettas.show', ['zetta' => $zetta]);
    }

    public function edit(Zetta $zetta)
    {
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }
        return view('zettas.edit', ['zetta' => $zetta]);
    }

    public static function destroy(Zetta $zetta)
    {
         if(!Auth::check()){


                return redirect("login")->withSuccess('You are not allowed to access');
            }
        $zetta = Zetta::find($zetta->id)->delete();

        $zettas = Zetta::all();

        return redirect()->route('zettas.index');
    }

    public function store(Request $request)
    {
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }

        $this->validate($request, array(
            //'title' => 'required|max:100|min:5',

        'gender' => 'required|min:1', 
        'name' => 'required|max:100', 
        'lastName' => 'required', 


        ));
        $zetta = new Zetta();


       // $zetta->title = $request->input("title"); //THIS
                $zetta->gender = $request->gender; 
        $zetta->name = $request->name; 
        $zetta->lastName = $request->lastName; 


        $zetta->save();
        return redirect()->back()->with("success", "Created New Zetta!");
    }

    public function update(Request $request, Zetta $zetta)
    {
         if(!Auth::check()){


                return redirect("login")->withSuccess('You are not allowed to access');
            }
        $this->validate($request, array(

        'gender' => 'required|min:1', 
        'name' => 'required|max:100', 
        'lastName' => 'required', 

        ));

        $zetta->gender = $request->gender; 
        $zetta->name = $request->name; 
        $zetta->lastName = $request->lastName; 


        $zetta->save();

        return view('zettas.show', ['zetta' => $zetta])->withSuccess("Edited");

    }

}
