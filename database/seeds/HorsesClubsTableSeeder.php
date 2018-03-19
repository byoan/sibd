<?php

use Illuminate\Database\Seeder;

class HorsesClubsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\HorseClub::class, 100000)->create();
    }
}
