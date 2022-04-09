<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    DB::table('users')->insert([
	    'admin'    => 1,
            'name'     => 'Fatima Diraa',
            'email'    => 'diraa@test.com',
            'phone' => '0614125717',
            'post' => 'super manager',
            'password' => bcrypt('12345678'),
        ]);
    }
}
