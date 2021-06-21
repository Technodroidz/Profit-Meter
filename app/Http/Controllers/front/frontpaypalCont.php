<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class frontpaypalCont extends Controller
{
  
    public function payWithPaypal()
    {
        return view('paywithpaypal');
    }
}
