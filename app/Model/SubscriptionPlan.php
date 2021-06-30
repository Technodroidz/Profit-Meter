<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionPlan extends Model
{
    use SoftDeletes;
    protected $table    = 'subscription_plans';
    protected $dates    = ['deleted_at'];
    protected $guarded  = [];

    public static function getTrialPlan()
    {
        return SubscriptionPlan::where('package_name_slug','trial-plan')->first();
    }

    public static function getAllPlans()
    {
        return SubscriptionPlan::where('package_name_slug','!=','trial-plan')->where('deleted_at',null)->get();
    }

    public static function getSubscriptionPlanById($id)
    {
        return SubscriptionPlan::where('id',$id)->first();
    }

}


