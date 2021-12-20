<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moderator extends Model
{
    use HasFactory;

    public static function isModerator($id){

       $count= Moderator::query()->where("userID",'=',$id)->count();

        if($count>0){
            return true;

        }

        return false;

    }

}
