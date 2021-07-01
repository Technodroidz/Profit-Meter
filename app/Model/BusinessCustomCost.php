<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BusinessCustomCost extends Model
{
    protected $table = 'business_custom_costs';
    protected $guarded = []; 
    use SoftDeletes;

    public function getCategory(){
        return $this->hasOne(BusinessCategory::class,'id','category_id');
    }

}

