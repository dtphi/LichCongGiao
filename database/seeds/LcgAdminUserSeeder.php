<?php

use Illuminate\Database\Seeder;

class LcgAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\LcgModels\LcgAdmin::class, 2)->create();
    }
}
