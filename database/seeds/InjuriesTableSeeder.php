<?php

use Illuminate\Database\Seeder;

class InjuriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Injuries::class, 100000)->create();
    }
}
