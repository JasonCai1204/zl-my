<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class DoctorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('doctors')->insert([
            'avatar' => '/images/logo.png',
            'name' => '陈沛锐',
            'grading' => '主任医师',
            'brief' => '在恶性肿瘤治疗方面，有丰富的理论与实践经验，尤其在中医药和中西医结合治疗肿瘤方面有着丰富的临床经验。',
            'introduction' => '主任导师、学术带头人，中医内科学博士生导师。广东省名中医，国家人事部、卫生部、中医药管理局任命的第二批全国老中医药专家。全国中医肿瘤学会常委，中国抗癌协会肿瘤传统医学委员会委员，全国中医内科学会常委，呼吸专业委员会荣誉主任委员（原主任委员）及肿瘤专业委员会副主任委员。',
            'phone' => '18565700980',
            'password' => bcrypt('secret'),
            'hospital_id' => 1
        ]);

        DB::table('doctors')->insert([
            'avatar' => '/images/logo.png',
            'name' => '陈沛伟',
            'grading' => '主任医师',
            'brief' => '在恶性肿瘤治疗方面，有丰富的理论与实践经验，尤其在中医药和中西医结合治疗肿瘤方面有着丰富的临床经验。',
            'introduction' => '主任导师、学术带头人，中医内科学博士生导师。广东省名中医，国家人事部、卫生部、中医药管理局任命的第二批全国老中医药专家。全国中医肿瘤学会常委，中国抗癌协会肿瘤传统医学委员会委员，全国中医内科学会常委，呼吸专业委员会荣誉主任委员（原主任委员）及肿瘤专业委员会副主任委员。',
            'phone' => '14718070980',
            'password' => bcrypt('secret'),
            'hospital_id' => 1
        ]);

        DB::table('doctors')->insert([
            'avatar' => '/images/logo.png',
            'name' => '蔡炜',
            'grading' => '主任医师',
            'brief' => '在恶性肿瘤治疗方面，有丰富的理论与实践经验，尤其在中医药和中西医结合治疗肿瘤方面有着丰富的临床经验。',
            'introduction' => '主任导师、学术带头人，中医内科学博士生导师。广东省名中医，国家人事部、卫生部、中医药管理局任命的第二批全国老中医药专家。全国中医肿瘤学会常委，中国抗癌协会肿瘤传统医学委员会委员，全国中医内科学会常委，呼吸专业委员会荣誉主任委员（原主任委员）及肿瘤专业委员会副主任委员。',
            'phone' => '13823595730',
            'password' => bcrypt('secret'),
            'hospital_id' => 2
        ]);
    }
}
