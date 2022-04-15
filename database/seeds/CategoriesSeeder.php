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
    		['name' => '{"es": "Bebidas", "en": "Drinks"}', 'slug' => 'bebidas', 'image' => 'bebidas.jpg', 'state' => '1'],
    		['name' => '{"es": "Desayunos", "en": "breakfasts"}', 'slug' => 'desayunos', 'image' => 'categories.jpg', 'state' => '1'],
    		['name' => '{"es": "Almuerzos", "en": "Lunches"}', 'slug' => 'almuerzos', 'image' => 'categories.jpg', 'state' => '1'],
    		['name' => '{"es": "Packs", "en": "Packs"}', 'slug' => 'packs', 'image' => 'categories.jpg', 'state' => '1'],
            ['name' => '{"es": "Pizzas", "en": "Pizzas"}', 'slug' => 'pizzas', 'image' => 'pizzas.jpg', 'state' => '1'],
            ['name' => '{"es": "Pollo", "en": "Chicken"}', 'slug' => 'pollo', 'image' => 'pollo.jpg', 'state' => '1'],
            ['name' => '{"es": "Hamburguesas", "en": "Burgers"}', 'slug' => 'hamburguesas', 'image' => 'hamburguesas.jpg', 'state' => '1'],
            ['name' => '{"es": "Sushi", "en": "Sushi"}', 'slug' => 'sushi', 'image' => 'sushi.jpg', 'state' => '1'],
            ['name' => '{"es": "Alitas de Pollo", "en": "Chicken Wings"}', 'slug' => 'alitas-de-pollo', 'image' => 'alitas.jpg', 'state' => '1'],
            ['name' => '{"es": "Postres", "en": "Desserts"}', 'slug' => 'postres', 'image' => 'postres.jpg', 'state' => '1'],
            ['name' => '{"es": "Perros Calientes", "en": "Hot Dogs"}', 'slug' => 'perros-calientes', 'image' => 'perros.jpg', 'state' => '1']
    	];
    	DB::table('categories')->insert($categories);
    }
}
