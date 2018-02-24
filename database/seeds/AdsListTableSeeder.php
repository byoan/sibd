<?php

use Illuminate\Database\Seeder;

class AdsListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\AdList::class, 100000)->create();
    }
}
