<?php

use Illuminate\Database\Seeder;
use App\model\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
                'role' => 'admin',
                'image' => '',
                'created_by' => 'system'
            ]);
    }
}
