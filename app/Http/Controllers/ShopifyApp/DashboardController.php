<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Log;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        
        $shop       = Auth::user();
        $data       = ['current_link' => 'home'];
        // $domain     = $shop->getDomain()->toNative();
        
        // $shopApi    = $shop->api()->rest('GET', '/admin/shop.json')['body']['shop'];
        // $shopApi    = $shop->api()->rest('GET', '/admin/shop.json')['body'];
        
        // Log::info("Shop {$domain}'s object:" . json_encode($shop));
        // Log::info("Shop {$domain}'s API objct:" . json_encode($shopApi));
        // return;
        return view('business_app/content_template/dashboard',$data);
    }

}
