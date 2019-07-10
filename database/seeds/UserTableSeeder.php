<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'email' => 'employee@example.com',
        	'password' => 'secret',
            'name' => 'Employee Name',
            'gender' => 'Male',
            'phone' => '97034952035',
            'work' => 'Karyawan Swasta',
        	'image' => ''
        ]);
    }
}
