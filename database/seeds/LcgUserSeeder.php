<?php

use Illuminate\Database\Seeder;

class LcgUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\LcgModels\LcgUser::class, 2)->create();
    }
}
