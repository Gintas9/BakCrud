<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Alpha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlphaController extends Controller
{
    public function index()
    {

        $alphas = Alpha::all();
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }

        return view('alphas.index', ['alphas' => $alphas]);
    }

    public function show(Alpha $alpha)
    {
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }
        $alphas = Alpha::all();

        return view('alphas.show', ['alpha' => $alpha]);
    }

    public function edit(Alpha $alpha)
    {
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }
        return view('alphas.edit', ['alpha' => $alpha]);
    }

    public static function destroy(Alpha $alpha)
    {
         if(!Auth::check()){


                return redirect("login")->withSuccess('You are not allowed to access');
            }
        $alpha = Alpha::find($alpha->id)->delete();

        $alphas = Alpha::all();

        return redirect()->route('alphas.index');
    }

    public function store(Request $request)
    {
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }

        $this->validate($request, array(
            //'title' => 'required|max:100|min:5',

        'name' => 'required', 
        'age' => 'required', 
        'car' => 'required', 


        ));
        $alpha = new Alpha();


       // $alpha->title = $request->input("title"); //THIS
                $alpha->name = $request->name; 
        $alpha->age = $request->age; 
        $alpha->car = $request->car; 


        $alpha->save();
        return redirect()->back()->with("success", "Created New Alpha!");
    }

    public function update(Request $request, Alpha $alpha)
    {
         if(!Auth::check()){


                return redirect("login")->withSuccess('You are not allowed to access');
            }
        $this->validate($request, array(

        'name' => 'required', 
        'age' => 'required', 
        'car' => 'required', 

        ));

        $alpha->name = $request->name; 
        $alpha->age = $request->age; 
        $alpha->car = $request->car; 


        $alpha->save();

        return view('alphas.show', ['alpha' => $alpha])->withSuccess("Edited");

    }

}
