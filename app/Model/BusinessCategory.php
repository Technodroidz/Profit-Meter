<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

use DB;
class BusinessCategory extends Model
{
   
   // protected $connection= Auth::User()->database_name;
    
    protected $guarded = []; 
    protected $connection ='tenant';
    protected $table = 'business_categories';
  
    public function __construct()
    {
        // $this->connection = Auth::User()->database_name;
    }
    // public static function boot()
    // {
    //     static::addGlobalScope('ignore_web_series_category', function (Builder $builder) {
    //     $builder->where('deleted_at',null);
    //     });
    // }
    
   
}
