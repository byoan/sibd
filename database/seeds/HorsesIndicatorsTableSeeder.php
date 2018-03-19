<?php

use Illuminate\Database\Seeder;

class HorsesIndicatorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\HorseIndicators::class, 100000)->create();
    }
}
