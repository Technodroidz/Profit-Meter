<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ShippingCostCountryRule extends Model
{
    protected $connection ='';

    public function __construct($database_name = '')
    {
        $this->connection = $database_name ? $database_name : Auth::User()->database_name;
    }
}
