<?php

use Illuminate\Database\Seeder;

class GroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$groups = [
    		['name' => '{"es": "Sabores", "en": "Tastes"}', 'slug' => 'sabores', 'condition' => '1', 'min' => '1', 'max' => '1', 'state' => '1', 'attribute_id' => 2],
    		['name' => '{"es": "Leches", "en": "Milks"}', 'slug' => 'leches', 'condition' => '1', 'min' => '1', 'max' => '1', 'state' => '1', 'attribute_id' => 3],
    		['name' => '{"es": "Guarniciones", "en": "Fittings"}', 'slug' => 'guarniciones', 'condition' => '0', 'min' => '0', 'max' => '2', 'state' => '1', 'attribute_id' => 1],
            ['name' => '{"es": "Jugos", "en": "Juices"}', 'slug' => 'jugos', 'condition' => '1', 'min' => '3', 'max' => '3', 'state' => '1', 'attribute_id' => 4],
            ['name' => '{"es": "Frutas", "en": "Fruits"}', 'slug' => 'frutas', 'condition' => '1', 'min' => '2', 'max' => '3', 'state' => '1', 'attribute_id' => 5]
    	];
    	DB::table('groups')->insert($groups);
    }
}
