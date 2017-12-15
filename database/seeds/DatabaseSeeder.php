<?php

use Illuminate\Database\Seeder;
//By Sao Guang
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //$this->call(RoleTableSeeder::class);
        $this->call(UsersBasicInfoTableSeeder::class);
    }
}
