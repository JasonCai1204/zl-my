<?php

use Illuminate\Database\Seeder;

class InstancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('instances')->insert([
//            'id' => 1,
            'name' => '肺癌',
            'type_id' => 1,
            'sort' => 1
        ]);

        DB::table('instances')->insert([
//            'id' => 2,
            'name' => '食管癌',
            'type_id' => 1,
            'sort' => 2
        ]);

        DB::table('instances')->insert([
//            'id' => 3,
            'name' => '其他胸部肿瘤',
            'type_id' => 1,
            'sort' => 3
        ]);

        DB::table('instances')->insert([
//            'id' => 4,
            'name' => '胃癌',
            'type_id' => 2,
            'sort' => 1
        ]);

        DB::table('instances')->insert([
//            'id' => 5,
            'name' => '直肠癌',
            'type_id' => 2,
            'sort' => 2
        ]);

        DB::table('instances')->insert([
//            'id' => 6,
            'name' => '乳腺纤维瘤',
            'type_id' => 2,
            'sort' => 3
        ]);

        DB::table('instances')->insert([
//            'id' => 7,
            'name' => '结直肠癌',
            'type_id' => 3,
            'sort' => 1
        ]);

        DB::table('instances')->insert([
//            'id' => 8,
            'name' => '其他胃肠肿瘤',
            'type_id' => 3,
            'sort' => 2
        ]);

        DB::table('instances')->insert([
//            'id' => 9,
            'name' => '其他胃肠肿瘤',
            'type_id' => 3,
            'sort' => 3
        ]);

    }
}
