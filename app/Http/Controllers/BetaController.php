<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Beta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BetaController extends Controller
{
    public function index()
    {

        $betas = Beta::all();
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }

        return view('betas.index', ['betas' => $betas]);
    }

    public function show(Beta $beta)
    {
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }
        $betas = Beta::all();

        return view('betas.show', ['beta' => $beta]);
    }

    public function edit(Beta $beta)
    {
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }
        return view('betas.edit', ['beta' => $beta]);
    }

    public static function destroy(Beta $beta)
    {
         if(!Auth::check()){


                return redirect("login")->withSuccess('You are not allowed to access');
            }
        $beta = Beta::find($beta->id)->delete();

        $betas = Beta::all();

        return redirect()->route('betas.index');
    }

    public function store(Request $request)
    {
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }

        $this->validate($request, array(
            //'title' => 'required|max:100|min:5',

        'name' => 'required', 
        'bkeyid' => 'required', 


        ));
        $beta = new Beta();


       // $beta->title = $request->input("title"); //THIS
                $beta->name = $request->name; 
        $beta->bkeyid = $request->bkeyid; 


        $beta->save();
        return redirect()->back()->with("success", "Created New Beta!");
    }

    public function update(Request $request, Beta $beta)
    {
         if(!Auth::check()){


                return redirect("login")->withSuccess('You are not allowed to access');
            }
        $this->validate($request, array(

        'name' => 'required', 
        'bkeyid' => 'required', 

        ));

        $beta->name = $request->name; 
        $beta->bkeyid = $request->bkeyid; 


        $beta->save();

        return view('betas.show', ['beta' => $beta])->withSuccess("Edited");

    }

}
