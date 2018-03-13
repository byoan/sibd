<?php

use Illuminate\Database\Seeder;

class ParasitesListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ParasiteList::class, 100000)->create();
    }
}
