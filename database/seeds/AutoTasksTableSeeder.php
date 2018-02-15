<?php

use Illuminate\Database\Seeder;

class AutoTasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\AutoTask::class, 1000)->create();
    }
}
