<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
    		['name' => 'Bebidas', 'slug' => 'bebidas', 'state' => '1'],
    		['name' => 'Desayunos', 'slug' => 'desayunos', 'state' => '1'],
    		['name' => 'Almuerzos', 'slug' => 'almuerzos', 'state' => '1'],
    		['name' => 'Packs', 'slug' => 'packs', 'state' => '1']
    	];
    	DB::table('categories')->insert($categories);
    }
}
