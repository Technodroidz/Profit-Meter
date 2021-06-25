<?php

use Illuminate\Database\Seeder;
use App\Model\SubscriptionPlan;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubscriptionPlan::truncate();
        
        $data = [
            [
                'package_name'      => 'Trial plan',
                'package_amount'    => 0,
                'package_name_slug' => 'trial-plan',
                'package_duration'  => 15,
                'short_decription'  => 'A Data Analysis Plan (DAP) is about putting thoughts into a plan of action. Research',
                'package_log_description' => 'A Data Analysis Plan (DAP) is about putting thoughts into a plan of action. Research',
                'status' => 1
            ]
        ];

        SubscriptionPlan::insert($data);
    }
}
