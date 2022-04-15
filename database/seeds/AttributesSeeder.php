<?php

use Illuminate\Database\Seeder;

class AttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attributes = [
    		['name' => '{"es": "Tipo", "en": "Type"}', 'slug' => 'tipo', 'state' => '1'],
            ['name' => '{"es": "Sabor", "en": "Taste"}', 'slug' => 'sabor', 'state' => '1'],
            ['name' => '{"es": "Leche", "en": "Milk"}', 'slug' => 'leche', 'state' => '1'],
            ['name' => '{"es": "Jugo", "en": "Juice"}', 'slug' => 'jugo', 'state' => '1'],
            ['name' => '{"es": "Fruta", "en": "Fruit"}', 'slug' => 'fruta', 'state' => '1']
    	];
    	DB::table('attributes')->insert($attributes);
    }
}
