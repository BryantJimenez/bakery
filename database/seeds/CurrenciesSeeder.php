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
            ['name' => 'Dólar Estadounidense', 'slug' => 'dolar-estadounidense', 'iso' => 'USD', 'symbol' => '$', 'state' => '1'],
    		['name' => 'Euro', 'slug' => 'euro', 'iso' => 'EUR', 'symbol' => '€', 'state' => '1'],
    		['name' => 'Peso Uruguayo', 'slug' => 'peso-uruguayo', 'iso' => 'UYU', 'symbol' => '$', 'state' => '1']
    	];
    	DB::table('currencies')->insert($currencies);
    }
}
