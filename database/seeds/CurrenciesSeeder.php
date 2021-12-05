<?php

use Illuminate\Database\Seeder;

class CurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [
            ['name' => 'US Dollar', 'slug' => 'us-dollar', 'iso' => 'USD', 'symbol' => '$', 'state' => '1'],
    		['name' => 'Euro', 'slug' => 'euro', 'iso' => 'EUR', 'symbol' => '€', 'state' => '1'],
    		['name' => 'Uruguayan Peso', 'slug' => 'uruguayan-peso', 'iso' => 'UYU', 'symbol' => '$', 'state' => '1']
    	];
    	DB::table('currencies')->insert($currencies);
    }
}
