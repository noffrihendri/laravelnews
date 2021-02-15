<?php

use App\Mbrand;
use Illuminate\Database\Seeder;

class brandseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['brand_name' => 'elektronik','brand_name' => 'food'];
        foreach ($data as $key => $value) {
            # code...
            $brand = Mbrand::create($value);
        }
    
    }
}
