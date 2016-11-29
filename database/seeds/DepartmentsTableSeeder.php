<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'id' => 1,
            'name' => '系统管理专家',
        ]);

        DB::table('departments')->insert([
            'id' => 2,
            'name' => '客户服务专家',
        ]);
    }
}
