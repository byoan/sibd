<?php

use Illuminate\Database\Seeder;

class WeathersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Weather::class, 17587)->create();
    }
}
