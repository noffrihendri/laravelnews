<?php

use Illuminate\Database\Seeder;
use app\models\Muser_role;

class Roleseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = array(
            array(
                'role_name' =>'super admin',
                'is_active' => 1,
                'created_by' => '',
                'updated_by' => ''
            ),
            array(
                'role_name' =>'owner',
                'is_active' => 1,
                'created_by' => '',
                'updated_by' => ''
            ),
            array(
                'role_name' =>'operator',
                'is_active' => 1,
                'created_by' => '',
                'updated_by' => ''
            ),        
            array(
                'role_name' =>'user',
                'is_active' => 1,
                'created_by' => '',
                'updated_by' => ''
            ),
            array(
                'role_name' => 'guests',
                'is_active' => 1,
                'created_by' => '',
                'updated_by' =>''
            ),
        );

        foreach ($role as $value) {
            Muser_role::create($value);
        }


    }
}
