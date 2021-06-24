<?php

use Illuminate\Database\Seeder;
use App\Model\EmailTemplate;
class EmailTempleteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EmailTemplate::truncate();
        $data = [
            [
                'name'  => 'Subscription retainment',
                'description' => ' Dear {name}, 

                Your {subscription_name}  amount is {subscription_amount}  plan durantion {subscription_duration} has been activated .
                
                Thank you.  ',
                'page_type' => 'subscription_retainment',
            ],[
                
                'name'  => 'Registration',
                'description' => 'Dear   {last_name} {first_name} ,

                your account has been registered. your email id    {email} and mobile number  {mobile_number} .
                
                Thank you.',
                'page_type' => 'registration',
            ],[
              
                'name'  => 'Forgot password',
                'description' => 'Demo {email} ,

                Click here to reset your password {link}.',
                'page_type' => 'forgot_password',
            ],[
               
                'name'  => 'Subscription expired',
                'description' => ' Dear {name},

                Your {subscription_name}  amount is {subscription_amount}  plan durantion {subscription_duration} has been expired .
                
                Thank you.  ',
                'page_type' => 'Ssubscription_expired',
            ]
        ];
        EmailTemplate::insert($data);
    }
}
