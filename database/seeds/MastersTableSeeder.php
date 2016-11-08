<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('masters')->insert([
            'name' => '陈沛锐',
            'phone' => '18565700980',
            'password' => bcrypt('secret'),
            'position_id' => 1,
            'updated_at' => \Carbon\Carbon::now(),
            'created_at' => \Carbon\Carbon::now()
        ]);

         DB::table('masters')->insert([
             'name' => '蔡炜',
             'phone' => '13823595730',
             'password' => bcrypt('secret'),
             'position_id' => 1
         ]);
        //
        // DB::table('staff')->insert([
        //     'name' => '陈沛伟',
        //     'phone' => '13642442844',
        //     'password' => bcrypt('secret'),
        //     'position_id' => 2
        // ]);
        //
        // DB::table('staff')->insert([
        //     'name' => '李一男',
        //     'phone' => '14718070980',
        //     'password' => bcrypt('secret'),
        //     'position_id' => 2
        // ]);
    }
}
