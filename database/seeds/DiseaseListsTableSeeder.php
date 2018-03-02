<?php

use Illuminate\Database\Seeder;

class DiseaseListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\DiseasesList::class, 100000)->create();
    }
}
