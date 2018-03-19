<?php

use Illuminate\Database\Seeder;

class ItemsFamiliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ItemFamily::class, 10)->create();
    }
}
