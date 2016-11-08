<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cases')->insert([
            'name' => '肺癌',
            'type_id' => 1,
            'rank' => 1
        ]);

        DB::table('cases')->insert([
            'name' => '食管癌',
            'type_id' => 1,
            'rank' => 2
        ]);

        DB::table('cases')->insert([
            'name' => '其他胸部肿瘤',
            'type_id' => 1,
            'rank' => 3
        ]);


        DB::table('cases')->insert([
            'name' => '胃癌',
            'type_id' => 2,
            'rank' => 1
        ]);

        DB::table('cases')->insert([
            'name' => '直肠癌',
            'type_id' => 2,
            'rank' => 2
        ]);

        DB::table('cases')->insert([
            'name' => '其他胃肠肿瘤',
            'type_id' => 2,
            'rank' => 3
        ]);
    }
}
