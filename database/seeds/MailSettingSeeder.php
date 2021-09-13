<?php

use Illuminate\Database\Seeder;
use App\Model\Setting;

class MailSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Setting::truncate();
        Setting::where('setting_type','MAIL')->delete();
        $data = [
            [
                'input_type'   => 'text',
                'option_name'  => 'MAIL_DRIVER',
                'option_value' => 'smtp',
                'setting_type' => 'MAIL',
            ],[
                'input_type'   => 'text',
                'option_name'  => 'MAIL_HOST',
                'option_value' => 'smtp.gmail.com',
                'setting_type' => 'MAIL',
            ],[
                'input_type'   => 'text',
                'option_name'  => 'MAIL_PORT',
                'option_value' => '587',
                'setting_type' => 'MAIL',
            ],[
                'input_type'   => 'text',
                'option_name'  => 'MAIL_USERNAME',
                'option_value' => 'profitmeterapp@gmail.com',
                'setting_type' => 'MAIL',
            ],[
                'input_type'   => 'text',
                'option_name'  => 'MAIL_PASSWORD',
                'option_value' => 'xwrawhhlkhhplvtx',
                'setting_type' => 'MAIL',
            ],[
                'input_type'   => 'text',
                'option_name'  => 'MAIL_ENCRYPTION',
                'option_value' => 'tls',
                'setting_type' => 'MAIL',
            ],[
                'input_type'   => 'text',
                'option_name'  => 'MAIL_FROM_ADDRESS',
                'option_value' => 'profitmeterapp@gmail.com',
                'setting_type' => 'MAIL',
            ],[
                'input_type'   => 'text',
                'option_name'  => 'MAIL_FROM_NAME',
                'option_value' => 'Profitrack',
                'setting_type' => 'MAIL',
            ]
        ];
        Setting::insertOrIgnore($data);
    }
}
