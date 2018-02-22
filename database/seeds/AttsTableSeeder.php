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
        factory(App\Atts::class, 1000)->create();
    }
}
