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
        factory(App\HorseClub::class, 1000)->create();
    }
}
