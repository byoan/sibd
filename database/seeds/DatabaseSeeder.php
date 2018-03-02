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
        $this->call(AdsTableSeeder::class);
        $this->call(AdsListTableSeeder::class);
        $this->call(AttsTableSeeder::class);
        $this->call(AutoTasksTableSeeder::class);
        $this->call(ContestsTableSeeder::class);
        $this->call(DiseaseListsTableSeeder::class);
        $this->call(DiseasesTableSeeder::class);
        $this->call(HorsesTableSeeder::class);
        $this->call(IndicatorsTableSeeder::class);
        $this->call(InfrastructuresTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        $this->call(NewspapersTableSeeder::class);
        $this->call(NewsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
