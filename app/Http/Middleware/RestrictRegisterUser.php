<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class RestrictRegisterUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::User()){
            if(empty(Auth::User()->shopify_url) || empty(Auth::User()->shopify_access_token)){
                return redirect()->route('connect_shopify_account');
            }

            if(session()->get('user_subscribed') == false){
                $allowed_urls = ['business/settings/rules','business/settings/account','business/settings/upgrade_plan','business/settings/subscribe-stripe-payment'];

                if(!in_array($request->path(), $allowed_urls)){
                    return redirect()->route('business_setting_account');
                }
            }
        }
        return $next($request);
    }
}
