<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class CheckAuthOnCredScreens
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
            }else{
                return redirect()->route('home');
            }
        }
        return $next($request);
    }
}
