<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use PHPShopify\ShopifySDK;
use Log;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        
        $config = array(
            'ShopUrl' => Auth::User()->shopify_url,
            'AccessToken' => Auth::User()->shopify_access_token,
        );
        $shopify    = new \PHPShopify\ShopifySDK($config);
        
        $shop = $shopify->Shop->get();
        // pp($shop);
        $data = ['current_link' => 'home','shop' => $shop];
        // $data = ['current_link' => 'home'];
        
        return view('business_app/content_template/dashboard',$data);
    }

}
