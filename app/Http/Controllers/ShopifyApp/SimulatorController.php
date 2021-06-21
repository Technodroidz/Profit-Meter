<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SimulatorController extends Controller
{
    public function simulator(Request $request)
    {
        return view('business_app/content_template/simulator');
    }
}
