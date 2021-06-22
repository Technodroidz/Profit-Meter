<?php

use Illuminate\Database\Seeder;
use App\Model\Page;
class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::truncate();
        $data = [
            [
                'title'  => 'Privacy Policy',
                'long_description' => 'sb-ymttk6449799_api1.business.example.com',
                'page_type' => 'privacy_policy',
            ],[
                
                'title'  => 'Term Conditions',
                'long_description' => 'sha_8ft7dft6fdtf67d6f6d67f',
                'page_type' => 'terms_conditions',
            ],[
              
                'title'  => 'About US',
                'long_description' => 'sb-ymttk6449799_api1.business.example.com',
                'page_type' => 'about_us',
            ],[
               
                'title'  => 'FAQ',
                'long_description' => 'sb-ymttk6449799_api1.business.example.com',
                'page_type' => 'faq',
            ]
        ];
        Page::insert($data);
    }
}
