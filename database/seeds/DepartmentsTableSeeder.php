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
            'id' => 8602,
            'name' => '信息技术部',
        ]);

        DB::table('departments')->insert([
            'id' => 8603,
            'name' => '客户服务部',
        ]);
    }
}
