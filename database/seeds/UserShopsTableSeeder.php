<?php

use Illuminate\Database\Seeder;

class UserShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\UserShop::class, 100000)->create();
    }
}
