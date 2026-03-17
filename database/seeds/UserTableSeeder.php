<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        DB::table('users')->insert(array(
            0 =>
            array(
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'role' => 'admin',
                'email_verified_at' => NULL,
                'password' => Hash::make('admin123'),
            ),
        ));
    }
}
