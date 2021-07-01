<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserGoogleAccount extends Model
{
    protected $fillable = ['*'];

    public static function getGoogleAccountByUserid($user_id)
    {
        return UserGoogleAccount::where('user_id',$user_id)->first();
    }
}
