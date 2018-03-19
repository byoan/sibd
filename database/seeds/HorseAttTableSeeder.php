<?php

use Illuminate\Database\Seeder;

class HorseAttTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\HorseAtt::class, 2000000)->create();
    }
}
