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
            'phone_number' => '18565700980',
            'password' => bcrypt('secret'),
            'updated_at' => \Carbon\Carbon::now(),
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('masters')->insert([
            'id' => 860202,
            'department_id' => 8602,
            'name' => '蔡炜',
            'phone_number' => '13823595730',
            'password' => bcrypt('secret'),
            'updated_at' => \Carbon\Carbon::now(),
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('masters')->insert([
            'id' => 860203,
            'department_id' => 8601,
            'name' => '李一男',
            'phone_number' => '14718070983',
            'password' => bcrypt('secret'),
            'updated_at' => \Carbon\Carbon::now(),
            'created_at' => \Carbon\Carbon::now()
        ]);
    }
}
