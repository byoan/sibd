<?php

use Illuminate\Database\Seeder;

class WeathersListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\WeatherList::class, 1000)->create();
    }
}
