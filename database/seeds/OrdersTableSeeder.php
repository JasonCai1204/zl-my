<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

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
                'name' => '李一男',
                'phone' => '18565700980',
                'wechat' => 'igeneral76',
                'doctor_id' => 1,
                'item_id' => 1,
                'remark' => '我没有吸烟。',
                'photos' => json_encode([
                    '/images/1.jpg',
                    '/images/2.jpg',
                    '/images/3.jpg',
                    '/images/4.jpg'
                ]),
                'paid_at' => \Carbon\Carbon::now(),
                'reported_at' => \Carbon\Carbon::now(),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        );

        DB::table('orders')->insert(
            [
                'name' => '张三',
                'phone' => '14718070980',
                'wechat' => 'fucking123',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        );
    }
}
