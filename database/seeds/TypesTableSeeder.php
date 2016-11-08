<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
            'name' => '胸部肿瘤',
            'photo' => '/images/logo.png',
            'rank' => 1
        ]);

        DB::table('types')->insert([
            'name' => '胃肠肿瘤',
            'photo' => '/images/logo.png',
            'rank' => 2
        ]);

        DB::table('types')->insert([
            'name' => '肝胆胰肿瘤',
            'photo' => '/images/logo.png',
            'rank' => 3
        ]);
    }
}
