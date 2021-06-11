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
            if(empty(Auth::User()->shopify_url)){

                // return redirect()->route('connect_shopify_account');
            }
        }
        return $next($request);
    }
}
