<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Gint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GintController extends Controller
{
    public function index()
    {

        $gints = Gint::all();
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }

        return view('gints.index', ['gints' => $gints]);
    }

    public function show(Gint $gint)
    {
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }
        $gints = Gint::all();

        return view('gints.show', ['gint' => $gint]);
    }

    public function edit(Gint $gint)
    {
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }
        return view('gints.edit', ['gint' => $gint]);
    }

    public static function destroy(Gint $gint)
    {
         if(!Auth::check()){


                return redirect("login")->withSuccess('You are not allowed to access');
            }
        $gint = Gint::find($gint->id)->delete();

        $gints = Gint::all();

        return redirect()->route('gints.index');
    }

    public function store(Request $request)
    {
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }

        $this->validate($request, array(
            //'title' => 'required|max:100|min:5',

        'name' => 'required', 


        ));
        $gint = new Gint();


       // $gint->title = $request->input("title"); //THIS
                $gint->name = $request->name; 


        $gint->save();
        return redirect()->back()->with("success", "Created New Gint!");
    }

    public function update(Request $request, Gint $gint)
    {
         if(!Auth::check()){


                return redirect("login")->withSuccess('You are not allowed to access');
            }
        $this->validate($request, array(

        'name' => 'required', 

        ));

        $gint->name = $request->name; 


        $gint->save();

        return view('gints.show', ['gint' => $gint])->withSuccess("Edited");

    }

}
