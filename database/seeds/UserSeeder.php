<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'id' => '1',
                'fullname' => 'admin',
                'username' => 'admin',
                'password' => Hash::make('Vnpt@123'),
                'role_id' => '1'
            ],
        );
    }
}
