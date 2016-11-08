<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class HospitalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hospitals')->insert([
            'name' => '广州中山大学附属肿瘤医院',
            'grading' => '三甲',
            'city_id' => 1,
            'rank' => 1
        ]);

        DB::table('hospitals')->insert([
            'name' => '广州医学院附属肿瘤医院',
            'grading' => '三甲',
            'city_id' => 1,
            'rank' => 2
        ]);

        DB::table('hospitals')->insert([
            'name' => '广州复大肿瘤医院北院区',
            'grading' => '三甲',
            'city_id' => 2,
            'rank' => 1
        ]);
    }
}
