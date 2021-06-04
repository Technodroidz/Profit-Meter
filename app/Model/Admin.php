<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable
{
    // use HasFactory;

    protected $guarded = [];

    public function getUserType(){
        return $this->hasOne(Role::class,'role_name','role');
    }
}
