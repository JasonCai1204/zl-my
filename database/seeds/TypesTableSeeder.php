<?php

use Illuminate\Database\Seeder;

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
//            'id' => 1,
            'name' => '胸部肿瘤',
            'icon' => 'http://tse2.mm.bing.net/th?id=OIP.M2b75abef0f9f5a12d52daa282fb81f31o2&pid=15.1',
            'sort' => 1
        ]);

        DB::table('types')->insert([
//            'id' => 2,
            'name' => '胃肠肿瘤',
            'icon' => 'http://tse2.mm.bing.net/th?id=OIP.M2b75abef0f9f5a12d52daa282fb81f31o2&pid=15.1',
            'sort' => 2
        ]);

        DB::table('types')->insert([
//            'id' => 3,
            'name' => '肝胆胰肿瘤',
            'icon' => 'http://tse2.mm.bing.net/th?id=OIP.M2b75abef0f9f5a12d52daa282fb81f31o2&pid=15.1',
            'sort' => 3
        ]);
    }
}
