<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ban extends Model
{
    use HasFactory;

    public static function isBanned($id){
        $count= Ban::query()->where("userID",'=',$id)->count();

        if($count>0){
            return true;

        }

        return false;
    }

}
