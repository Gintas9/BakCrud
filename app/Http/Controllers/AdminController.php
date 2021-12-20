<?php

namespace App\Http\Controllers;

use App\Console\Commands\CRUDJSON;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Moderator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\This;


class AdminController extends Controller
{
    public function index()
    {

        $admins = Admin::all();
        if(!Auth::check()){


            return redirect("login")->withSuccess('You are not allowed to access');

        }

        if (Moderator::isModerator(Auth::id()) == true) {

            return view('admins.index', ['admins' => $admins]);

        }


        return view("main")->withAdmins($admins)->withSuccess("You are not administrator!");

    }

    public function show(Admin $admin)
    {

        $admins = Admin::all();
        if (Moderator::isModerator(Auth::id()) == true) {

            return view('admins.show', ['admin' => $admin]);

        }


        return view("main")->withAdmins($admins)->withSuccess("You are not administrator!");


    }

    public function edit(Admin $admin)
    {
        $admins = Admin::all();
        if (Moderator::isModerator(Auth::id()) == true) {

            return view('admins.edit', ['admin' => $admin]);

        }
        return view("main")->withAdmins($admins)->withSuccess("You are not administrator!");

    }

    public static function destroy(Admin $admin)
    {
        $name = $admin->baseName;
      $admin = Admin::find($admin->id)->delete();
      $admins = Admin::all();
      Artisan::call('crudgen:CRUD', ['name' => $name, '--delete' => true ]);
        return redirect()->route('admins.index');
    }
    public function resubmitController(Admin $admin)
    {
        $name = $admin->baseName;

        $jsonName = strtolower($name)."JSON.json";
        Artisan::call('crudgen:utils', ['name' => $name, '--item' => 'controller','--delete'=>true]);
        Artisan::call('crudgen:controller', ['name' => $name, '--json' => $jsonName,'--force'=>true ]);
        return redirect()->route('admins.index');
    }
    public function resubmitView(Admin $admin)
    {
        $name = $admin->baseName;
        $jsonName = strtolower($name)."JSON.json";

        Artisan::call('crudgen:view', ['name' => $name, '--json' => $jsonName ]);
        return redirect()->route('admins.index');
    }

    public function resubmitMigration(Admin $admin){
        $name = $admin->baseName;
        $jsonName = strtolower($name)."JSON.json";
        Artisan::call('crudgen:migration', ['name' => $name, '--json' => $jsonName ]);
        return redirect()->route('admins.index');
    }


    public function store(Request $request)
    {

        $this->validate($request, array(
            //'title' => 'required|max:100|min:5',

        'baseName' => 'required', 
        'vars' => 'required', 
        'validation' => 'required', 
        'inputs' => 'required', 


        ));

        $jsonPathName=strtolower($request->baseName)."JSON.json";



        if( preg_match("/^\s*$/" , $request->foreignKey) == 0  ){
            Artisan::call('crudgen:json', ['name' => $request->baseName, '--vars' => $request->vars, '--validation' => $request->validation, '--inputs' => $request->inputs,'--keys'=>$request->foreignKey]);

        }else {
            Artisan::call('crudgen:json', ['name' => $request->baseName, '--vars' => $request->vars, '--validation' => $request->validation, '--inputs' => $request->inputs]);

        }


       Artisan::call('crudgen:CRUD', ['name' => $request->baseName, '--json' => $jsonPathName ]);
       // Artisan::call('crudgen:view', ['name' => $request->baseName, '--json' => $jsonPathName ]);


        $admin = new Admin();


       // $admin->title = $request->input("title"); //THIS
                $admin->baseName = $request->baseName; 
        $admin->vars = $request->vars; 
        $admin->validation = $request->validation; 
        $admin->inputs = $request->inputs; 
        $admin->foreignKey = $request->foreignKey;


        $admin->save();

        //php artisan crudgen:json Admin --vars="string:baseName,string:vars,string:validation,string:inputs" --validation="baseName,required-vars,required-validation,required-inputs,required" --inputs="baseName,text-vars,text-validation,text-inputs,text"
        //CRUDJSON::creatAdminPanelJson($request->baseName);


        return redirect()->back()->with("success", "Created New Admin!");
    }

    public function update(Request $request, Admin $admin)
    {
        $this->validate($request, array(

        'baseName' => 'required', 
        'vars' => 'required', 
        'validation' => 'required', 
        'inputs' => 'required', 

        ));

        $admin->baseName = $request->baseName; 
        $admin->vars = $request->vars; 
        $admin->validation = $request->validation; 
        $admin->inputs = $request->inputs;
        $admin->foreignKey = $request->foreignKey;

        Artisan::call('crudgen:json', ['name' => $request->baseName, '--vars' => $request->vars,'--validation'=>$request->validation,'--inputs'=>$request->inputs]);

        $admin->save();

        return view('admins.show', ['admin' => $admin])->withSuccess("Edited");

    }

}
