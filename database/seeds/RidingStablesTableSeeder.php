<?php

use Illuminate\Database\Seeder;

class RidingStablesListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\RidingStable::class, 1000)->create();
    }
}