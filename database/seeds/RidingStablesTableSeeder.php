<?php

use Illuminate\Database\Seeder;

class RidingStablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\RidingStable::class, 100000)->create();
    }
}
