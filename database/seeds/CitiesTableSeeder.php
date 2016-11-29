<?php

use Illuminate\Database\Seeder;

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
//            'id' => 1,
            'name' => '北京',
        ]);

        DB::table('cities')->insert([
//            'id' => 2,
            'name' => '上海',
        ]);

        DB::table('cities')->insert([
//            'id' => 3,
            'name' => '广州',
        ]);

    }
}
