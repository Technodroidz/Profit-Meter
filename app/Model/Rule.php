<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $fillable = ['user_id','financial_status','zero_value_order','cancelled_order','order_tags','pos','draft_order','order_channels','customer_tags','refund_order_cost_to_zero','assign_original_order_date_to_refund'];
    public static function insertRules($insert_array)
    {
        Rule::insert($insert_array);
    }

    public static function getRuleByUserId($user_id)
    {
        return Rule::where('user_id',$user_id)->first();
    }
}
