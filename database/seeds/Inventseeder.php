<?php

use Illuminate\Database\Seeder;

class Inventseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $invent = factory(App\Minventtable::class, 2)->create();
    }
}
