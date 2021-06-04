<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Permission extends Model
{
    protected $table="tbl_nav_menu";
    use SoftDeletes; 

    protected $fillable = [
        'user_id', 'nav_name', 'nav_link','status','role_id'
    ];

    public function getUserName(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
