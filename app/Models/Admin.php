<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;

class Admin extends Model
{
    use HasFactory;


    public static function resubmitController(Admin $admin)
    {
        $name = $admin->baseName;
        $controllerName=$admin->baseName.'Controller.php';
        $jsonName = strtolower(name)."JSON.json";

        Artisan::call('crudgen:controller', ['name' => $name, '--json' => $jsonName ]);
        return redirect()->route('admins.index');
    }

}
