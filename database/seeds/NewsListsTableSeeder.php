<?php

use Illuminate\Database\Seeder;

class NewsListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\NewsList::class, 100000)->create();
    }
}
