<?php

use Illuminate\Database\Seeder;
use App\Mrole;

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
                'keterangan' =>'admin'
            ),
            array(
                'keterangan' =>'owner'
            ),
            array(
                'keterangan' =>'operator'
            ),        
            array(
                'keterangan' =>'user'
            ),
        );

        foreach ($role as $value) {
            Mrole::create($value);
        }


    }
}
