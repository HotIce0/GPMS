<?php

use Illuminate\Database\Seeder;
//By Sao Guang
class UsersBasicInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_users_basic_info')->insert([
            'user_job_id' => '1234567',
            'email' => '1234567@qq.com',
            'user_name' => '李桂峰',
            'password' => bcrypt('1234567'),
            'role_id' => 2,
            'user_type' => 0,
            'user_info_id' => 1,
        ]);
    }
}
