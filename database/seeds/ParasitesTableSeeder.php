<?php

use Illuminate\Database\Seeder;

class ParasitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Parasite::class, 100000)->create();
    }
}
