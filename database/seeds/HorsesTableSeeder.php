<?php

use Illuminate\Database\Seeder;

class HorsesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Horse::class, 1000)->create();
    }
}
