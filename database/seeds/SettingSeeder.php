<?php

use Illuminate\Database\Seeder;
use App\Model\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::truncate();
        $data = [
            [
                'input_type'   => 'text',
                'option_name'  => 'stripe_app_key',
                'option_value' => 'jdhgshbdsdtvs6dtsY',
                'setting_type' => 'STRIPE',
            ],[
                'input_type'   => 'text',
                'option_name'  => 'stripe_secret_key',
                'option_value' => 'sha_8ft7dft6fdtf67d6f6d67f',
                'setting_type' => 'STRIPE',
            ],[
                'input_type'   => 'text',
                'option_name'  => 'stripe_currency',
                'option_value' => 'USD',
                'setting_type' => 'STRIPE',
            ]
            // ,[
            //     'input_type'   => 'text',
            //     'option_name'  => 'paypal_api_username',
            //     'option_value' => 'sb-ymttk6449799_api1.business.example.com',
            //     'setting_type' => 'PAYPAL',
            // ],[
            //     'input_type'   => 'text',
            //     'option_name'  => 'paypal_api_password',
            //     'option_value' => 'G95BGDHSTRYGVZJ3',
            //     'setting_type' => 'PAYPAL',
            // ],[
            //     'input_type'   => 'text',
            //     'option_name'  => 'paypal_api_signature',
            //     'option_value' => 'AmtOMfrGlbkvUIEemQaQR85l4R2AA3Du8-YGpl9aXxpLmzBnRMOoreCE',
            //     'setting_type' => 'PAYPAL',
            // ],[
            //     'input_type'   => 'text',
            //     'option_name'  => 'paypal_currency',
            //     'option_value' => 'USD',
            //     'setting_type' => 'PAYPAL',
            // ],[
            //     'input_type'   => 'text',
            //     'option_name'  => 'paypal_status',
            //     'option_value' => '1',
            //     'setting_type' => 'PAYPAL',
            // ]
        ];
        Setting::insert($data);
    }
}
