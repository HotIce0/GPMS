<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_role')->insert([
            'role_id' => 1,
            'role_name' => 'admin',
            'role_permission' => json_encode(array()),
        ]);
        DB::table('t_role')->insert([
            'role_id' => 2,
            'role_name' => 'student',
            'role_permission' => json_encode(array()),
        ]);
        DB::table('t_role')->insert([
            'role_id' => 3,
            'role_name' => 'teacher',
            'role_permission' => json_encode(array()),
        ]);
    }
}
