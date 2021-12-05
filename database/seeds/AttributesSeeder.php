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
    		['name' => 'Type', 'slug' => 'type', 'state' => '1'],
            ['name' => 'Flavor', 'slug' => 'flavor', 'state' => '1'],
            ['name' => 'Milk', 'slug' => 'milk', 'state' => '1'],
            ['name' => 'Juice', 'slug' => 'juice', 'state' => '1'],
            ['name' => 'Fruit', 'slug' => 'fruit', 'state' => '1']
    	];
    	DB::table('attributes')->insert($attributes);
    }
}
