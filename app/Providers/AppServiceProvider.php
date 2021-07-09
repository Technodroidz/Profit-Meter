<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Model\CompanyDetail;
use App\Model\Setting;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       
        // $data['getcompany'] = CompanyDetail::get();
     
        // View::share('getbasic', $data);

        $env_properties = null;  
        if (Schema::hasTable('env_properties')) {
            $env_properties = Setting::where('setting_type','MAIL')->get();
        }

        if (!is_null($env_properties)) {
            foreach ($env_properties as $envprop) {
                Config::set('env.'.$envprop->option_name, $envprop->option_value);
            }
        }
    }
}
