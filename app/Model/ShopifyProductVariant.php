<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ShopifyProductVariant extends Model
{
    protected $connection ='tenant';

    public function __construct()
    {
        // $this->connection = null !== Auth::User() ? Auth::User()->database_name : $database_name;
    }
}
