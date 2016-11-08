<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            'name' => '广州',
            'rank' => 1
        ]);

        DB::table('cities')->insert([
            'name' => '北京',
            'rank' => 2
        ]);

        DB::table('cities')->insert([
            'name' => '上海',
            'rank' => 3
        ]);
    }
}
