<?php

use Illuminate\Database\Seeder;

class AttsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Att::class, 2000000)->create();
    }
}
