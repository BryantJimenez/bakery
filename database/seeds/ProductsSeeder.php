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
    		['name' => '{"es": "Refresco", "en": "Soda"}', 'slug' => 'refresco', 'image' => 'soda.jpg', 'description' => '{"es": "La bebida carbonatada es una bebida aromatizada, elaborada con agua carbonatada y edulcorantes naturales.", "en": "The carbonated drink is a flavored drink, made with carbonated water and natural sweeteners."}', 'price' => 1.90, 'state' => '1', 'category_id' => 1],
    		['name' => '{"es": "Agua", "en": "Water"}', 'slug' => 'agua', 'image' => 'water.jfif', 'description' => '{"es": "Bebida natural fría.", "en": "Cold natural drink."}', 'price' => 1.90, 'state' => '1', 'category_id' => 1],
    		['name' => '{"es": "Jugo", "en": "Juice"}', 'slug' => 'jugo', 'image' => 'juice.jpg', 'description' => '{"es": "Jugo obtenido exprimiendo una fruta.", "en": "Juice obtained by squeezing a fruit."}', 'price' => 1.90, 'state' => '1', 'category_id' => 1],
    		['name' => '{"es": "Cacaolat", "en": "Cacaolat"}', 'slug' => 'cacaolat', 'image' => 'cacaolat.jfif', 'description' => '{"es": "Bebida de chocolate a base de cacao.", "en": "Cocoa-based chocolate drink."}', 'price' => 2.20, 'state' => '1', 'category_id' => 1],
            ['name' => '{"es": "Sandwich", "en": "Sandwich"}', 'slug' => 'sandwich', 'image' => 'sandwich.png', 'description' => '{"es": "Un sándwich es un alimento que generalmente consta de verduras, queso en rodajas o carne, que se coloca sobre o entre rebanadas de pan.", "en": "A sandwich is a food item that usually consists of vegetables, sliced cheese, or meat, placed on or between slices of bread."}', 'price' => 3.00, 'state' => '1', 'category_id' => 3],
            ['name' => '{"es": "Pack de Jugos", "en": "Juice Pack"}', 'slug' => 'pack-de-jugos', 'image' => 'juice.jpg', 'description' => '{"es": "Un paquete de jugo de tres jugos.", "en": "A juice pack of three juices."}', 'price' => 5.00, 'state' => '1', 'category_id' => 4],
            ['name' => '{"es": "Pack de Frutas", "en": "Fruit Pack"}', 'slug' => 'pack-de-frutas', 'image' => 'products.jpg', 'description' => '{"es": "Un gran paquete de deliciosas frutas.", "en": "A large pack of delicious fruits."}', 'price' => 10.00, 'state' => '1', 'category_id' => 4]
    	];
    	DB::table('products')->insert($products);
    }
}
