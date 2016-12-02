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
            'name' => '广州',
        ]);

        DB::table('cities')->insert([
            'name' => '北京',
        ]);

        DB::table('cities')->insert([
            'name' => '上海',
        ]);
    }
}
