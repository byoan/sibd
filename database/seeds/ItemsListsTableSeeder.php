<?php

use Illuminate\Database\Seeder;

class ItemsListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ItemList::class, 100000)->create();
    }
}
