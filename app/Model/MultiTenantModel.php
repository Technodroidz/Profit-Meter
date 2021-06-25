<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use DB;

class MultiTenantModel extends Model
{
    public static function getTenantUser()
    {
        // return DB::connection(Auth::User()->database_name)->table('tenant_user')->get();
    }
}
