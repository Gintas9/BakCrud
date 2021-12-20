<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Xi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class XiController extends Controller
{
    public function index()
    {

        $xis = Xi::all();
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }

        return view('xis.index', ['xis' => $xis]);
    }

    public function show(Xi $xi)
    {
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }
        $xis = Xi::all();

        return view('xis.show', ['xi' => $xi]);
    }

    public function edit(Xi $xi)
    {
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }
        return view('xis.edit', ['xi' => $xi]);
    }

    public static function destroy(Xi $xi)
    {
         if(!Auth::check()){


                return redirect("login")->withSuccess('You are not allowed to access');
            }
        $xi = Xi::find($xi->id)->delete();

        $xis = Xi::all();

        return redirect()->route('xis.index');
    }

    public function store(Request $request)
    {
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }

        $this->validate($request, array(
            //'title' => 'required|max:100|min:5',

        'name' => 'required|min:1|email', 
        'age' => 'required|min:1|email', 


        ));
        $xi = new Xi();


       // $xi->title = $request->input("title"); //THIS
                $xi->name = $request->name; 
        $xi->age = $request->age; 


        $xi->save();
        return redirect()->back()->with("success", "Created New Xi!");
    }

    public function update(Request $request, Xi $xi)
    {
         if(!Auth::check()){


                return redirect("login")->withSuccess('You are not allowed to access');
            }
        $this->validate($request, array(

        'name' => 'required|min:1|email', 
        'age' => 'required|min:1|email', 

        ));

        $xi->name = $request->name; 
        $xi->age = $request->age; 


        $xi->save();

        return view('xis.show', ['xi' => $xi])->withSuccess("Edited");

    }

}
