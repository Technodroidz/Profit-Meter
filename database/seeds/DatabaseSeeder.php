<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SettingSeeder::class);
        $this->call(AdminRoleSeeder::class);
        $this->call(PagesSeeder::class);
        $this->call(EmailTempleteSeeder::class);
        $this->call(SubscriptionPlanSeeder::class);
    }
}
