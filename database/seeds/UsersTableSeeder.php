<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => '蔡炜',
            'phone_number' => '13823595730',
            'password' => bcrypt('secret'),
            'updated_at' => \Carbon\Carbon::now(),
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('users')->insert([
            'name' => '陈沛锐',
            'phone_number' => '18565700980',
            'password' => bcrypt('secret'),
            'updated_at' => \Carbon\Carbon::now(),
            'created_at' => \Carbon\Carbon::now()
        ]);
    }
}
