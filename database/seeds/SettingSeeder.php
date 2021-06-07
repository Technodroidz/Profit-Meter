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
            ],[
                'input_type'   => 'text',
                'option_name'  => 'paypal_app_key',
                'option_value' => 'jdhgshbdsdtvs6dtsY',
                'setting_type' => 'PAYPAL',
            ],[
                'input_type'   => 'text',
                'option_name'  => 'paypal_secret_key',
                'option_value' => 'sha_8ft7dft6fdtf67d6f6d67f',
                'setting_type' => 'PAYPAL',
            ],[
                'input_type'   => 'text',
                'option_name'  => 'paypal_currency',
                'option_value' => 'USD',
                'setting_type' => 'PAYPAL',
            ],[
                'input_type'   => 'text',
                'option_name'  => 'smtp_server_host',
                'option_value' => '',
                'setting_type' => 'MAIL',
            ],[
                'input_type'   => 'text',
                'option_name'  => 'smtp_port_number',
                'option_value' => '',
                'setting_type' => 'MAIL',
            ],[
                'input_type'   => 'text',
                'option_name'  => 'smtp_user',
                'option_value' => '',
                'setting_type' => 'MAIL',
            ],[
                'input_type'   => 'text',
                'option_name'  => 'smtp_username',
                'option_value' => '',
                'setting_type' => 'MAIL',
            ],[
                'input_type'   => 'text',
                'option_name'  => 'smtp_password',
                'option_value' => '',
                'setting_type' => 'MAIL',
            ],[
                'input_type'   => 'text',
                'option_name'  => 'email_sign',
                'option_value' => '',
                'setting_type' => 'MAIL',
            ],[
                'input_type'   => 'text',
                'option_name'  => 'email_encryption_type',
                'option_value' => '',
                'setting_type' => 'MAIL',
            ],
        ];
        Setting::insert($data);
    }
}