<?php

use Illuminate\Database\Seeder;

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
//            'id' => 1,
            'avatar' => 'http://tse2.mm.bing.net/th?id=OIP.M2b75abef0f9f5a12d52daa282fb81f31o2&pid=15.1',
            'name' => '盛祥',
            'grading' => '主任医师',
            'introduction' => '主任导师、学术带头人，中医内科学博士生导师。广东省名中医，国家人事部、卫生部、中医药管理局任命的第二批全国老中医药专家。全国中医肿瘤学会常委，中国抗癌协会肿瘤传统医学委员会委员，全国中医内科学会常委，呼吸专业委员会荣誉主任委员（原主任委员）及肿瘤专业委员会副主任委员。',
            'phone_number' => '18565700911',
            'password' => bcrypt('secret'),
            'hospital_id' => 1,
            'is_certified' => 1,
            'is_recommended' => 0,
        ]);

        DB::table('doctors')->insert([
//            'id' => 2,
            'avatar' => 'http://tse2.mm.bing.net/th?id=OIP.M2b75abef0f9f5a12d52daa282fb81f31o2&pid=15.1',
            'name' => '浩辰',
            'grading' => '主任医师',
            'introduction' => '主任导师、学术带头人，中医内科学博士生导师。广东省名中医，国家人事部、卫生部、中医药管理局任命的第二批全国老中医药专家。全国中医肿瘤学会常委，中国抗癌协会肿瘤传统医学委员会委员，全国中医内科学会常委，呼吸专业委员会荣誉主任委员（原主任委员）及肿瘤专业委员会副主任委员。',
            'phone_number' => '18565700981',
            'password' => bcrypt('secret'),
            'hospital_id' => 1,
            'is_certified' => 0,
            'is_recommended' => 1,
        ]);

        DB::table('doctors')->insert([
//            'id' => 3,
            'avatar' => 'http://tse2.mm.bing.net/th?id=OIP.M2b75abef0f9f5a12d52daa282fb81f31o2&pid=15.1',
            'name' => '皓澄',
            'grading' => '主任医师',
            'introduction' => '主任导师、学术带头人，中医内科学博士生导师。广东省名中医，国家人事部、卫生部、中医药管理局任命的第二批全国老中医药专家。全国中医肿瘤学会常委，中国抗癌协会肿瘤传统医学委员会委员，全国中医内科学会常委，呼吸专业委员会荣誉主任委员（原主任委员）及肿瘤专业委员会副主任委员。',
            'phone_number' => '18565700982',
            'password' => bcrypt('secret'),
            'hospital_id' => 2,
            'is_certified' => 1,
            'is_recommended' => 0,
        ]);

        DB::table('doctors')->insert([
//            'id' => 4,
            'avatar' => 'http://tse2.mm.bing.net/th?id=OIP.M2b75abef0f9f5a12d52daa282fb81f31o2&pid=15.1',
            'name' => '天逸',
            'grading' => '主任医师',
            'introduction' => '主任导师、学术带头人，中医内科学博士生导师。广东省名中医，国家人事部、卫生部、中医药管理局任命的第二批全国老中医药专家。全国中医肿瘤学会常委，中国抗癌协会肿瘤传统医学委员会委员，全国中医内科学会常委，呼吸专业委员会荣誉主任委员（原主任委员）及肿瘤专业委员会副主任委员。',
            'phone_number' => '18565700983',
            'password' => bcrypt('secret'),
            'hospital_id' => 2,
            'is_certified' => 0,
            'is_recommended' => 1,
        ]);

        DB::table('doctors')->insert([
//            'id' => 5,
            'avatar' => 'http://tse2.mm.bing.net/th?id=OIP.M2b75abef0f9f5a12d52daa282fb81f31o2&pid=15.1',
            'name' => '初俊',
            'grading' => '主任医师',
            'introduction' => '主任导师、学术带头人，中医内科学博士生导师。广东省名中医，国家人事部、卫生部、中医药管理局任命的第二批全国老中医药专家。全国中医肿瘤学会常委，中国抗癌协会肿瘤传统医学委员会委员，全国中医内科学会常委，呼吸专业委员会荣誉主任委员（原主任委员）及肿瘤专业委员会副主任委员。',
            'phone_number' => '18565700984',
            'password' => bcrypt('secret'),
            'hospital_id' => 3,
            'is_certified' => 1,
            'is_recommended' => 0,
        ]);

        DB::table('doctors')->insert([
//            'id' => 6,
            'avatar' => 'http://tse2.mm.bing.net/th?id=OIP.M2b75abef0f9f5a12d52daa282fb81f31o2&pid=15.1',
            'name' => '腾诚',
            'grading' => '主任医师',
            'introduction' => '主任导师、学术带头人，中医内科学博士生导师。广东省名中医，国家人事部、卫生部、中医药管理局任命的第二批全国老中医药专家。全国中医肿瘤学会常委，中国抗癌协会肿瘤传统医学委员会委员，全国中医内科学会常委，呼吸专业委员会荣誉主任委员（原主任委员）及肿瘤专业委员会副主任委员。',
            'phone_number' => '18565700985',
            'password' => bcrypt('secret'),
            'hospital_id' => 3,
            'is_certified' => 0,
            'is_recommended' => 1,
        ]);

        DB::table('doctors')->insert([
//            'id' => 7,
            'avatar' => 'http://tse2.mm.bing.net/th?id=OIP.M2b75abef0f9f5a12d52daa282fb81f31o2&pid=15.1',
            'name' => '彬辰',
            'grading' => '主任医师',
            'introduction' => '主任导师、学术带头人，中医内科学博士生导师。广东省名中医，国家人事部、卫生部、中医药管理局任命的第二批全国老中医药专家。全国中医肿瘤学会常委，中国抗癌协会肿瘤传统医学委员会委员，全国中医内科学会常委，呼吸专业委员会荣誉主任委员（原主任委员）及肿瘤专业委员会副主任委员。',
            'phone_number' => '18565700986',
            'password' => bcrypt('secret'),
            'hospital_id' => 4,
            'is_certified' => 1,
            'is_recommended' => 0,
        ]);

        DB::table('doctors')->insert([
//            'id' => 8,
            'avatar' => 'http://tse2.mm.bing.net/th?id=OIP.M2b75abef0f9f5a12d52daa282fb81f31o2&pid=15.1',
            'name' => '彬星',
            'grading' => '主任医师',
            'introduction' => '主任导师、学术带头人，中医内科学博士生导师。广东省名中医，国家人事部、卫生部、中医药管理局任命的第二批全国老中医药专家。全国中医肿瘤学会常委，中国抗癌协会肿瘤传统医学委员会委员，全国中医内科学会常委，呼吸专业委员会荣誉主任委员（原主任委员）及肿瘤专业委员会副主任委员。',
            'phone_number' => '18565700987',
            'password' => bcrypt('secret'),
            'hospital_id' => 4,
            'is_certified' => 0,
            'is_recommended' => 1,
        ]);

        DB::table('doctors')->insert([
//            'id' => 9,
            'avatar' => 'http://tse2.mm.bing.net/th?id=OIP.M2b75abef0f9f5a12d52daa282fb81f31o2&pid=15.1',
            'name' => '骞枫',
            'grading' => '主任医师',
            'introduction' => '主任导师、学术带头人，中医内科学博士生导师。广东省名中医，国家人事部、卫生部、中医药管理局任命的第二批全国老中医药专家。全国中医肿瘤学会常委，中国抗癌协会肿瘤传统医学委员会委员，全国中医内科学会常委，呼吸专业委员会荣誉主任委员（原主任委员）及肿瘤专业委员会副主任委员。',
            'phone_number' => '18565700988',
            'password' => bcrypt('secret'),
            'hospital_id' => 5,
            'is_certified' => 1,
            'is_recommended' => 0,
        ]);

        DB::table('doctors')->insert([
//            'id' => 10,
            'avatar' => 'http://tse2.mm.bing.net/th?id=OIP.M2b75abef0f9f5a12d52daa282fb81f31o2&pid=15.1',
            'name' => '泽然',
            'grading' => '主任医师',
            'introduction' => '主任导师、学术带头人，中医内科学博士生导师。广东省名中医，国家人事部、卫生部、中医药管理局任命的第二批全国老中医药专家。全国中医肿瘤学会常委，中国抗癌协会肿瘤传统医学委员会委员，全国中医内科学会常委，呼吸专业委员会荣誉主任委员（原主任委员）及肿瘤专业委员会副主任委员。',
            'phone_number' => '18565700989',
            'password' => bcrypt('secret'),
            'hospital_id' => 5,
            'is_certified' => 0,
            'is_recommended' => 1,
        ]);

        DB::table('doctors')->insert([
//            'id' => 11,
            'avatar' => 'http://tse2.mm.bing.net/th?id=OIP.M2b75abef0f9f5a12d52daa282fb81f31o2&pid=15.1',
            'name' => '鸿皓',
            'grading' => '主任医师',
            'introduction' => '主任导师、学术带头人，中医内科学博士生导师。广东省名中医，国家人事部、卫生部、中医药管理局任命的第二批全国老中医药专家。全国中医肿瘤学会常委，中国抗癌协会肿瘤传统医学委员会委员，全国中医内科学会常委，呼吸专业委员会荣誉主任委员（原主任委员）及肿瘤专业委员会副主任委员。',
            'phone_number' => '18565700990',
            'password' => bcrypt('secret'),
            'hospital_id' => 6,
            'is_certified' => 1,
            'is_recommended' => 0,
        ]);

        DB::table('doctors')->insert([
//            'id' => 12,
            'avatar' => 'http://tse2.mm.bing.net/th?id=OIP.M2b75abef0f9f5a12d52daa282fb81f31o2&pid=15.1',
            'name' => '帝振',
            'grading' => '主任医师',
            'introduction' => '主任导师、学术带头人，中医内科学博士生导师。广东省名中医，国家人事部、卫生部、中医药管理局任命的第二批全国老中医药专家。全国中医肿瘤学会常委，中国抗癌协会肿瘤传统医学委员会委员，全国中医内科学会常委，呼吸专业委员会荣誉主任委员（原主任委员）及肿瘤专业委员会副主任委员。',
            'phone_number' => '18565700991',
            'password' => bcrypt('secret'),
            'hospital_id' => 6,
            'is_certified' => 0,
            'is_recommended' => 1,
        ]);

        DB::table('doctors')->insert([
//            'id' => 13,
            'avatar' => 'http://tse2.mm.bing.net/th?id=OIP.M2b75abef0f9f5a12d52daa282fb81f31o2&pid=15.1',
            'name' => '振骏',
            'grading' => '主任医师',
            'introduction' => '主任导师、学术带头人，中医内科学博士生导师。广东省名中医，国家人事部、卫生部、中医药管理局任命的第二批全国老中医药专家。全国中医肿瘤学会常委，中国抗癌协会肿瘤传统医学委员会委员，全国中医内科学会常委，呼吸专业委员会荣誉主任委员（原主任委员）及肿瘤专业委员会副主任委员。',
            'phone_number' => '18565700992',
            'password' => bcrypt('secret'),
            'hospital_id' => 7,
            'is_certified' => 1,
            'is_recommended' => 0,
        ]);

        DB::table('doctors')->insert([
//            'id' => 14,
            'avatar' => 'http://tse2.mm.bing.net/th?id=OIP.M2b75abef0f9f5a12d52daa282fb81f31o2&pid=15.1',
            'name' => '驰远',
            'grading' => '主任医师',
            'introduction' => '主任导师、学术带头人，中医内科学博士生导师。广东省名中医，国家人事部、卫生部、中医药管理局任命的第二批全国老中医药专家。全国中医肿瘤学会常委，中国抗癌协会肿瘤传统医学委员会委员，全国中医内科学会常委，呼吸专业委员会荣誉主任委员（原主任委员）及肿瘤专业委员会副主任委员。',
            'phone_number' => '18565700993',
            'password' => bcrypt('secret'),
            'hospital_id' => 7,
            'is_certified' => 0,
            'is_recommended' => 1,
        ]);

        DB::table('doctors')->insert([
//            'id' => 15,
            'avatar' => 'http://tse2.mm.bing.net/th?id=OIP.M2b75abef0f9f5a12d52daa282fb81f31o2&pid=15.1',
            'name' => '振嘉',
            'grading' => '主任医师',
            'introduction' => '主任导师、学术带头人，中医内科学博士生导师。广东省名中医，国家人事部、卫生部、中医药管理局任命的第二批全国老中医药专家。全国中医肿瘤学会常委，中国抗癌协会肿瘤传统医学委员会委员，全国中医内科学会常委，呼吸专业委员会荣誉主任委员（原主任委员）及肿瘤专业委员会副主任委员。',
            'phone_number' => '18565700994',
            'password' => bcrypt('secret'),
            'hospital_id' => 8,
            'is_certified' => 1,
            'is_recommended' => 0,
        ]);

        DB::table('doctors')->insert([
//            'id' => 16,
            'avatar' => 'http://tse2.mm.bing.net/th?id=OIP.M2b75abef0f9f5a12d52daa282fb81f31o2&pid=15.1',
            'name' => '骏爵',
            'grading' => '主任医师',
            'introduction' => '主任导师、学术带头人，中医内科学博士生导师。广东省名中医，国家人事部、卫生部、中医药管理局任命的第二批全国老中医药专家。全国中医肿瘤学会常委，中国抗癌协会肿瘤传统医学委员会委员，全国中医内科学会常委，呼吸专业委员会荣誉主任委员（原主任委员）及肿瘤专业委员会副主任委员。',
            'phone_number' => '18565700995',
            'password' => bcrypt('secret'),
            'hospital_id' => 8,
            'is_certified' => 0,
            'is_recommended' => 1,
        ]);

        DB::table('doctors')->insert([
//            'id' => 17,
            'avatar' => 'http://tse2.mm.bing.net/th?id=OIP.M2b75abef0f9f5a12d52daa282fb81f31o2&pid=15.1',
            'name' => '良震',
            'grading' => '主任医师',
            'introduction' => '主任导师、学术带头人，中医内科学博士生导师。广东省名中医，国家人事部、卫生部、中医药管理局任命的第二批全国老中医药专家。全国中医肿瘤学会常委，中国抗癌协会肿瘤传统医学委员会委员，全国中医内科学会常委，呼吸专业委员会荣誉主任委员（原主任委员）及肿瘤专业委员会副主任委员。',
            'phone_number' => '18565700996',
            'password' => bcrypt('secret'),
            'hospital_id' => 9,
            'is_certified' => 1,
            'is_recommended' => 0,
        ]);

        DB::table('doctors')->insert([
//            'id' => 18,
            'avatar' => 'http://tse2.mm.bing.net/th?id=OIP.M2b75abef0f9f5a12d52daa282fb81f31o2&pid=15.1',
            'name' => '寅家',
            'grading' => '主任医师',
            'introduction' => '主任导师、学术带头人，中医内科学博士生导师。广东省名中医，国家人事部、卫生部、中医药管理局任命的第二批全国老中医药专家。全国中医肿瘤学会常委，中国抗癌协会肿瘤传统医学委员会委员，全国中医内科学会常委，呼吸专业委员会荣誉主任委员（原主任委员）及肿瘤专业委员会副主任委员。',
            'phone_number' => '18565700997',
            'password' => bcrypt('secret'),
            'hospital_id' => 9,
            'is_certified' => 0,
            'is_recommended' => 1,
        ]);
    }
}
