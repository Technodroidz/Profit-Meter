<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class BusinessCustomCost extends Model
{
   
    protected $guarded = []; 
   
    protected $connection ='tenant';
    protected $table = 'business_custom_costs';
    
    public function __construct()
    {
        // $this->connection = Auth::User()->database_name;
    }
    public function getCategory(){
        return $this->hasOne(BusinessCategory::class,'id','category_id');
    }

}

