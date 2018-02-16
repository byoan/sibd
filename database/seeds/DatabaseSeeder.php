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
        $this->call(UsersTableSeeder::class);
        $this->call(AdsTableSeeder::class);
        $this->call(AutoTasksTableSeeder::class);
        $this->call(IndicatorsTableSeeder::class);
        $this->call(InfrastructuresTableSeeder::class);
        $this->call(DiseasesTableSeeder::class);
        $this->call(NewsTableSeeder::class);
    }
}
