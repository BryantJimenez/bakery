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
    		['name' => 'Bebidas', 'slug' => 'bebidas', 'image' => 'bebidas.jpg', 'state' => '1'],
    		['name' => 'Desayunos', 'slug' => 'desayunos', 'image' => 'categories.jpg', 'state' => '1'],
    		['name' => 'Almuerzos', 'slug' => 'almuerzos', 'image' => 'categories.jpg', 'state' => '1'],
    		['name' => 'Packs', 'slug' => 'packs', 'image' => 'categories.jpg', 'state' => '1'],
            ['name' => 'Pizzas', 'slug' => 'pizzas', 'image' => 'pizzas.jpg', 'state' => '1'],
            ['name' => 'Pollo', 'slug' => 'pollo', 'image' => 'pollo.jpg', 'state' => '1'],
            ['name' => 'Hamburguesas', 'slug' => 'hamburguesas', 'image' => 'hamburguesas.jpg', 'state' => '1'],
            ['name' => 'Sushi', 'slug' => 'sushi', 'image' => 'sushi.jpg', 'state' => '1'],
            ['name' => 'Alitas de Pollo', 'slug' => 'alitas-de-pollo', 'image' => 'alitas.jpg', 'state' => '1'],
            ['name' => 'Postres', 'slug' => 'postres', 'image' => 'postres.jpg', 'state' => '1'],
            ['name' => 'Perros Calientes', 'slug' => 'perros-calientes', 'image' => 'perros.jpg', 'state' => '1']
    	];
    	DB::table('categories')->insert($categories);
    }
}
