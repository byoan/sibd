<?php

use Illuminate\Database\Seeder;

class NewspapersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Newspaper::class, 17587)->create();
    }
}
