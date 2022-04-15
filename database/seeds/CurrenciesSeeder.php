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
            ['name' => '{"es": "Dólar Estadounidense", "en": "US Dollar"}', 'slug' => 'dolar-estadounidense', 'iso' => 'USD', 'symbol' => '$', 'state' => '1'],
    		['name' => '{"es": "Euro", "en": "Euro"}', 'slug' => 'euro', 'iso' => 'EUR', 'symbol' => '€', 'state' => '1'],
    		['name' => '{"es": "Peso Uruguayo", "en": "Uruguayan Peso"}', 'slug' => 'peso-uruguayo', 'iso' => 'UYU', 'symbol' => '$', 'state' => '1']
    	];
    	DB::table('currencies')->insert($currencies);
    }
}
