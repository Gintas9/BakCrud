<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\F;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FController extends Controller
{
    public function index()
    {

        $fs = F::all();
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }

        return view('fs.index', ['fs' => $fs]);
    }

    public function show(F $f)
    {
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }
        $fs = F::all();

        return view('fs.show', ['f' => $f]);
    }

    public function edit(F $f)
    {
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }
        return view('fs.edit', ['f' => $f]);
    }

    public static function destroy(F $f)
    {
         if(!Auth::check()){


                return redirect("login")->withSuccess('You are not allowed to access');
            }
        $f = F::find($f->id)->delete();

        $fs = F::all();

        return redirect()->route('fs.index');
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
        $f = new F();


       // $f->title = $request->input("title"); //THIS
                $f->name = $request->name; 


        $f->save();
        return redirect()->back()->with("success", "Created New F!");
    }

    public function update(Request $request, F $f)
    {
         if(!Auth::check()){


                return redirect("login")->withSuccess('You are not allowed to access');
            }
        $this->validate($request, array(

        'name' => 'required', 

        ));

        $f->name = $request->name; 


        $f->save();

        return view('fs.show', ['f' => $f])->withSuccess("Edited");

    }

}
