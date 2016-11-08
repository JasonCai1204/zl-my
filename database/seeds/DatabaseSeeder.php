<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CitiesTableSeeder::class);
        $this->call(MastersTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
        $this->call(TypesTableSeeder::class);
        $this->call(CasesTableSeeder::class);
        $this->call(HospitalsTableSeeder::class);
        $this->call(DoctorsTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
    }
}
