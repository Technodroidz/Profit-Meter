<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\SoftDeletes;

class UserSubscription extends Model
{
    use SoftDeletes;
    protected $guarded = []; 

    public static function insertUserSubscription($insertArray)
    {
        UserSubscription::insert($insertArray);
    }

    public static function getTrialSubscription($user_id)
    {
        return UserSubscription::where('user_id',$user_id)->where('is_trial',1)->first();
    }

    public static function getPaidSubscription($user_id)
    {
        return UserSubscription::where('user_id',$user_id)->where('is_trial',0)->where('subscription_status','active')->first();
    }
}
