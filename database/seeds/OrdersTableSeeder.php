<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert(
            [
                'id' => 100001,
                'user_id' => '1',
                'patient_name' => '李一男',
                'phone_number' => '18565700981',
                'instance_id' => 1,
                'doctor_id' => 1,
                'hospital_id' => 1,
                'gender' => 1,
                'birthday' => \Carbon\Carbon::now(),
                'smoking' => 1,
                'weight' => 50,
                'wechat_id' => 'abcd',
                'detail' => '情况良好',
                'photos' => '["/images/2016/11/22/1479806070/640638953708825067.jpg", "/images/2016/11/22/1479806071/input_defaultbg.png"]',
                'condition_report' => '情况良好',
                'send_to_the_doctor_at' => \Carbon\Carbon::now(),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        );

        DB::table('orders')->insert(
            [
                'id' => 100002,
                'user_id' => '1',
                'patient_name' => '李二男',
                'phone_number' => '18565700982',
                'instance_id' => 1,
                'doctor_id' => 1,
                'hospital_id' => 1,
                'gender' => 1,
                'birthday' => \Carbon\Carbon::now(),
                'smoking' => 1,
                'weight' => 50,
                'wechat_id' => 'abcd',
                'detail' => '情况良好',
                'photos' => '["/images/2016/11/22/1479806070/640638953708825067.jpg", "/images/2016/11/22/1479806071/input_defaultbg.png"]',
                'condition_report' => '情况良好',
                'send_to_the_doctor_at' => \Carbon\Carbon::now(),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        );
    }
}
