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
    		['name' => 'Flavors', 'slug' => 'flavors', 'condition' => '1', 'min' => '1', 'max' => '1', 'state' => '1', 'attribute_id' => 2],
    		['name' => 'Milks', 'slug' => 'milks', 'condition' => '1', 'min' => '1', 'max' => '1', 'state' => '1', 'attribute_id' => 3],
    		['name' => 'Fittings', 'slug' => 'fittings', 'condition' => '0', 'min' => '0', 'max' => '2', 'state' => '1', 'attribute_id' => 1],
            ['name' => 'Juices', 'slug' => 'juices', 'condition' => '1', 'min' => '3', 'max' => '3', 'state' => '1', 'attribute_id' => 4],
            ['name' => 'Fruits', 'slug' => 'fruits', 'condition' => '1', 'min' => '2', 'max' => '3', 'state' => '1', 'attribute_id' => 5]
    	];
    	DB::table('groups')->insert($groups);
    }
}
