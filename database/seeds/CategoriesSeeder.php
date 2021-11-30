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
    		['name' => 'Drinks', 'slug' => 'drinks', 'image' => 'bebidas.jpg', 'state' => '1'],
    		['name' => 'Breakfasts', 'slug' => 'breakfasts', 'image' => 'categories.jpg', 'state' => '1'],
    		['name' => 'Lunches', 'slug' => 'lunches', 'image' => 'categories.jpg', 'state' => '1'],
    		['name' => 'Packs', 'slug' => 'packs', 'image' => 'categories.jpg', 'state' => '1'],
            ['name' => 'Pizzas', 'slug' => 'pizzas', 'image' => 'pizzas.jpg', 'state' => '1'],
            ['name' => 'Chicken', 'slug' => 'chicken', 'image' => 'pollo.jpg', 'state' => '1'],
            ['name' => 'Burgers', 'slug' => 'burgers', 'image' => 'hamburguesas.jpg', 'state' => '1'],
            ['name' => 'Sushi', 'slug' => 'sushi', 'image' => 'sushi.jpg', 'state' => '1'],
            ['name' => 'Chicken Wings', 'slug' => 'chicken-wings', 'image' => 'alitas.jpg', 'state' => '1'],
            ['name' => 'Desserts', 'slug' => 'desserts', 'image' => 'postres.jpg', 'state' => '1'],
            ['name' => 'Hot Dogs', 'slug' => 'hot-dogs', 'image' => 'perros.jpg', 'state' => '1']
    	];
    	DB::table('categories')->insert($categories);
    }
}
