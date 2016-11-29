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
            'id' => 1,
            'department_id' => 1,
            'name' => '陈沛锐',
            'phone_number' => '18565700980',
            'password' => bcrypt('secret'),
            'updated_at' => \Carbon\Carbon::now(),
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('masters')->insert([
            'id' => 2,
            'department_id' => 1,
            'name' => '蔡炜',
            'phone_number' => '13823595730',
            'password' => bcrypt('secret'),
            'updated_at' => \Carbon\Carbon::now(),
            'created_at' => \Carbon\Carbon::now()
        ]);
        //
        // DB::table('staff')->insert([
        //     'name' => '陈沛伟',
        //     'phone' => '13642442844',
        //     'password' => bcrypt('secret'),
        //     'position_id' => 2
        // ]);
        //

        DB::table('masters')->insert([
            'id' => 3,
            'department_id' => 2,
            'name' => '李一男',
            'phone_number' => '14718070983',
            'password' => bcrypt('secret'),
            'updated_at' => \Carbon\Carbon::now(),
            'created_at' => \Carbon\Carbon::now()
        ]);
    }
}
