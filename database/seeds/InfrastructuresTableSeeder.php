<?php

use Illuminate\Database\Seeder;

class InfrastructuresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Infrastructure::class, 1000)->create();
    }
}
