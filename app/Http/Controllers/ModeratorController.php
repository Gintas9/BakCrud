<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Ban;
use App\Models\Moderator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ModeratorController extends Controller
{
    public function index()
    {


        $admins=Admin::all();
        $moderators = Moderator::all();
        $users=User::query()->select("users.*")->leftJoin('moderators','moderators.userID','=','users.id')->whereNull('moderators.id')->get();

        $bans=User::query()->select("users.*")->leftJoin('bans','bans.userID','=','users.id')->whereNull('bans.id')->get();
        $banned=Ban::all();
        if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');

        }
        if (Moderator::isModerator(Auth::id()) == true) {

            return view('moderators.index', ['moderators' => $moderators,'users' => $users,'bans'=>$bans,'banned'=>$banned]);

        }

        return view("main")->withAdmins($admins)->withSuccess("You are not Moderator!!");


    }

    public function show(Moderator $moderator)
    {

        $moderators = Moderator::all();

        return view('moderators.show', ['moderator' => $moderator]);
    }

    public function edit(Moderator $moderator)
    {

        return view('moderators.edit', ['moderator' => $moderator]);
    }

    public static function destroy(Moderator $moderator)
    {
        $moderator = Moderator::find($moderator->id)->delete();

        $moderators = Moderator::all();

        return redirect()->route('moderators.index');
    }

    public function store(Request $request)
    {

        $this->validate($request, array(
            //'title' => 'required|max:100|min:5',

        'userID' => 'required|min:1'


        ));
        $moderator = new Moderator();


       // $moderator->title = $request->input("title"); //THIS
                $moderator->userID = $request->userID;



        $moderator->save();
        return redirect()->back()->with("success", "Created New Moderator!");
    }

    public function update(Request $request, Moderator $moderator)
    {
        $this->validate($request, array(

            'userID' => 'required|min:1'

        ));

        $moderator->gender = $request->gender; 
        $moderator->name = $request->name; 
        $moderator->lastName = $request->lastName; 


        $moderator->save();

        return view('moderators.show', ['moderator' => $moderator])->withSuccess("Edited");

    }

    public static function getUserName($id){
        $user=User::find($id);

        return $user;
    }

}
