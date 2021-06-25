<?php

namespace App\Http\Middleware;
use DB;
use PDO;
use Config;
use Closure;
use Illuminate\Support\Facades\Auth;

class ConfigureMultiTenantDB
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
            if(isset(Auth::User()->database_name) && !empty(Auth::User()->database_name)){
                Config::set("database.connections.".Auth::User()->database_name, [
                    'driver'    => 'mysql',
                    'url'       => env('DATABASE_URL'),
                    'host'      => env('DB_HOST', '127.0.0.1'),
                    'port'      => env('DB_PORT', '3306'),
                    'database'  => Auth::User()->database_name,
                    'username'  => env('DB_USERNAME', 'forge'),
                    'password'  => env('DB_PASSWORD', ''),
                    'unix_socket'       => env('DB_SOCKET', ''),
                    'charset'           => 'utf8mb4',
                    'collation'         => 'utf8mb4_unicode_ci',
                    'prefix'            => '',
                    'prefix_indexes'    => true,
                    'strict'            => true,
                    'engine'            => null,
                    'options'           => extension_loaded('pdo_mysql') ? array_filter([
                        PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
                    ]) : []
                ]);
            }
        }
        return $next($request);
    }
}
