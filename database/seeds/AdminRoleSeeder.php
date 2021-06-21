<?php

use Illuminate\Database\Seeder;
use App\Model\Role;

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        $data = [
            [
                'role_name'  => 'ADMIN',
                'status'     => 1,
                'delete_id'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],[
                'role_name'  => 'OPERATOR',
                'status'     => 1,
                'delete_id'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],[
                'role_name'  => 'GEM',
                'status'     => 1,
                'delete_id'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],[
                'role_name'  => 'BILLING',
                'status'     => 1,
                'delete_id'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],[
                'role_name'  => 'SUPERADMIN',
                'status'     => 1,
                'delete_id'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]
        ];
        Role::insert($data);
    }
}
