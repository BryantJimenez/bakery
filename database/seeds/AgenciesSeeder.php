<?php

use App\Models\Agency;
use Illuminate\Database\Seeder;

class AgenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Agency::class, 5)->create(['state' => '1']);
    }
}
