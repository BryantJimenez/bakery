<?php

use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
    		['name' => 'Refresco', 'slug' => 'refresco', 'image' => 'soda.jpg', 'description' => 'La bebida carbonatada es una bebida aromatizada, elaborada con agua carbonatada y edulcorantes naturales.', 'price' => 1.90, 'state' => '1', 'category_id' => 1],
    		['name' => 'Agua', 'slug' => 'agua', 'image' => 'water.jfif', 'description' => 'Bebida natural fría.', 'price' => 1.90, 'state' => '1', 'category_id' => 1],
    		['name' => 'Jugo', 'slug' => 'jugo', 'image' => 'juice.jpg', 'description' => 'Jugo obtenido exprimiendo una fruta.', 'price' => 1.90, 'state' => '1', 'category_id' => 1],
    		['name' => 'Cacaolat', 'slug' => 'cacaolat', 'image' => 'cacaolat.jfif', 'description' => 'Bebida de chocolate a base de cacao.', 'price' => 2.20, 'state' => '1', 'category_id' => 1],
            ['name' => 'Sandwich', 'slug' => 'sandwich', 'image' => 'sandwich.png', 'description' => 'Un sándwich es un alimento que generalmente consta de verduras, queso en rodajas o carne, que se coloca sobre o entre rebanadas de pan.', 'price' => 3.00, 'state' => '1', 'category_id' => 3],
            ['name' => 'Pack de Jugos', 'slug' => 'pack-de-jugos', 'image' => 'juice.jpg', 'description' => 'Un paquete de jugo de tres jugos.', 'price' => 5.00, 'state' => '1', 'category_id' => 4],
            ['name' => 'Pack de Frutas', 'slug' => 'pack-de-frutas', 'image' => 'products.jpg', 'description' => 'Un gran paquete de deliciosas frutas.', 'price' => 10.00, 'state' => '1', 'category_id' => 4]
    	];
    	DB::table('products')->insert($products);
    }
}
