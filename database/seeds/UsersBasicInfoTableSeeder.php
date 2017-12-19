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
            'user_job_id' => '12345678',
            'email' => '12345678@qq.com',
            'user_name' => '甘靖',
            'password' => bcrypt('12345678'),
            'role_id' => 3,
            'user_type' => 1,
            'user_info_id' => 2,
        ]);
    }
}
