<?php

use Illuminate\Database\Seeder;

class Doctor_InstanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('doctor_instance')->insert([
            'doctor_id' => 1,
            'instance_id' => 1,
        ]);

        DB::table('doctor_instance')->insert([
            'doctor_id' => 1,
            'instance_id' => 2,
        ]);

        DB::table('doctor_instance')->insert([
            'doctor_id' =>2,
            'instance_id' => 3,
        ]);

        DB::table('doctor_instance')->insert([
            'doctor_id' => 3,
            'instance_id' => 4,
        ]);

        DB::table('doctor_instance')->insert([
            'doctor_id' => 4,
            'instance_id' => 5,
        ]);

        DB::table('doctor_instance')->insert([
            'doctor_id' => 5,
            'instance_id' => 6,
        ]);

        DB::table('doctor_instance')->insert([
            'doctor_id' => 6,
            'instance_id' => 7,
        ]);

        DB::table('doctor_instance')->insert([
            'doctor_id' => 7,
            'instance_id' => 8,
        ]);

        DB::table('doctor_instance')->insert([
            'doctor_id' => 8,
            'instance_id' =>9,
        ]);

        DB::table('doctor_instance')->insert([
            'doctor_id' => 9,
            'instance_id' => 8,
        ]);
    }
}
