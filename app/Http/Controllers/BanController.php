<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BanController extends Controller
{
    public function index()
    {

        $bans = Ban::all();
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }

        return view('bans.index', ['bans' => $bans]);
    }

    public function show(Ban $ban)
    {
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }
        $bans = Ban::all();

        return view('bans.show', ['ban' => $ban]);
    }

    public function edit(Ban $ban)
    {
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }
        return view('bans.edit', ['ban' => $ban]);
    }

    public static function destroy(Ban $ban)
    {
         if(!Auth::check()){


                return redirect("login")->withSuccess('You are not allowed to access');
            }
        $ban = Ban::find($ban->id)->delete();

        $bans = Ban::all();

        return redirect()->route('bans.index');
    }

    public function store(Request $request)
    {
     if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');
        }

        $this->validate($request, array(
            //'title' => 'required|max:100|min:5',

        'userID' => 'required', 


        ));
        $ban = new Ban();


       // $ban->title = $request->input("title"); //THIS
                $ban->userID = $request->userID; 


        $ban->save();
        return redirect()->back()->with("success", "Created New Ban!");
    }

    public function update(Request $request, Ban $ban)
    {
         if(!Auth::check()){


                return redirect("login")->withSuccess('You are not allowed to access');
            }
        $this->validate($request, array(

        'userID' => 'required', 

        ));

        $ban->userID = $request->userID; 


        $ban->save();

        return view('bans.show', ['ban' => $ban])->withSuccess("Edited");

    }

}
