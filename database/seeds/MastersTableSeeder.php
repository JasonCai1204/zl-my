<?php

use Illuminate\Database\Seeder;

class MastersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('masters')->insert([
            'id' => 860201,
            'department_id' => 8602,
            'name' => '陈沛锐',
            'phone_number' => '13926410980',
            'password' => bcrypt('secret'),
            'updated_at' => \Carbon\Carbon::now(),
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('masters')->insert([
            'id' => 860301,
            'department_id' => 8603,
            'name' => '黄映玲',
            'phone_number' => '13533599784',
            'password' => bcrypt('secret'),
            'updated_at' => \Carbon\Carbon::now(),
            'created_at' => \Carbon\Carbon::now()
        ]);

        // DB::table('masters')->insert([
        //     'id' => 860203,
        //     'department_id' => 8601,
        //     'name' => '李一男',
        //     'phone_number' => '14718070983',
        //     'password' => bcrypt('secret'),
        //     'updated_at' => \Carbon\Carbon::now(),
        //     'created_at' => \Carbon\Carbon::now()
        // ]);
    }
}
