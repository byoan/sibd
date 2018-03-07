<?php

use Illuminate\Database\Seeder;

class InjuriesListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\InjuriesList::class, 100000)->create();
    }
}
