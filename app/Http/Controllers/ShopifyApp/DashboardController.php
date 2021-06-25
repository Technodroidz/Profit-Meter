<?php

namespace App\Http\Controllers\ShopifyApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use PHPShopify\ShopifySDK;
use Log;
use App\Model\MultiTenantModel;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        
        // $config = array(
        //     'ShopUrl' => Auth::User()->shopify_url,
        //     'AccessToken' => Auth::User()->shopify_access_token,
        // );
        // $shopify    = new \PHPShopify\ShopifySDK($config);
        
        // $shop = $shopify->Shop->get();
        
        // $data = ['current_link' => 'home','shop' => $shop];
        // $tenant_user = MultiTenantModel::getTenantUser();
        // pp($tenant_user);
        $data = ['current_link' => 'home'];
        
        return view('business_app/content_template/dashboard',$data);
    }

}
