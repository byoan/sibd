<?php

use Illuminate\Database\Seeder;

class UserShopsListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\UserShop::class, 1000)->create();
    }
}
