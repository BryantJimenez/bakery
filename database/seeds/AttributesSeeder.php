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
    		['name' => 'Tipo', 'slug' => 'tipo', 'state' => '1'],
            ['name' => 'Sabor', 'slug' => 'sabor', 'state' => '1'],
            ['name' => 'Leche', 'slug' => 'leche', 'state' => '1'],
            ['name' => 'Jugo', 'slug' => 'jugo', 'state' => '1'],
            ['name' => 'Fruta', 'slug' => 'fruta', 'state' => '1']
    	];
    	DB::table('attributes')->insert($attributes);
    }
}
