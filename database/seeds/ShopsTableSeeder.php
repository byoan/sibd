<?php

use Illuminate\Database\Seeder;

class ShopsListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Shop::class, 1000)->create();
    }
}
