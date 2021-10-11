<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role')->insert(
            [   'id' => '1',
                'role_user' => 'admin',
            ],
        );
        DB::table('role')->insert(
            [   
                'id' => '2',
                'role_user' => 'Quản lý kho DHTT',
            ],
        );
        DB::table('role')->insert(
            [
                'id' => '3',
                'role_user' => 'KTT - Quản lý',
            ],
        );
        DB::table('role')->insert(
            [
                'id' => '4',
                'role_user' => 'KTT - Quản lý kho',
            ],
        );
        DB::table('role')->insert(
            [
                'id' => '5',
                'role_user' => 'KTT - Quản lý sửa chửa',
            ],
        );
    }
}
