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
                'patient_name' => '郭去病',
                'phone_number' => '18565700980',
                'instance_id' => 1,
                'doctor_id' => 1,
                'hospital_id' => 1,
                'gender' => 1,
                'birthday' => '1678-11-03 09:16:31',
                'smoking' => 1,
                'weight' => 46-50,
                'wechat_id' => 'loveforever',
                'detail' => '体重直线下降，等死中😭',
                'condition_report' => '患者已经放弃治疗，等死吧😄',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        );
    }
}
