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
    		['name' => 'Soda', 'slug' => 'soda', 'image' => 'soda.jpg', 'description' => 'Carbonated drink is a flavored drink, made with carbonated water and natural sweeteners.', 'price' => 1.90, 'state' => '1', 'category_id' => 1],
    		['name' => 'Water', 'slug' => 'water', 'image' => 'water.jfif', 'description' => 'Cold natural drink.', 'price' => 1.90, 'state' => '1', 'category_id' => 1],
    		['name' => 'Juice', 'slug' => 'juice', 'image' => 'juice.jpg', 'description' => 'Juice obtained by squeezing a fruit.', 'price' => 1.90, 'state' => '1', 'category_id' => 1],
    		['name' => 'Cacaolat', 'slug' => 'cacaolat', 'image' => 'cacaolat.jfif', 'description' => 'Cocoa-based chocolate drink.', 'price' => 2.20, 'state' => '1', 'category_id' => 1],
            ['name' => 'Sandwich', 'slug' => 'sandwich', 'image' => 'sandwich.png', 'description' => 'A sandwich is a food typically consisting of vegetables, sliced cheese or meat, placed on or between slices of bread.', 'price' => 3.00, 'state' => '1', 'category_id' => 3],
            ['name' => 'Juices Pack', 'slug' => 'juices-pack', 'image' => 'juice.jpg', 'description' => 'A juice pack of three juices.', 'price' => 5.00, 'state' => '1', 'category_id' => 4],
            ['name' => 'Fruits Pack', 'slug' => 'fruits-pack', 'image' => 'products.jpg', 'description' => 'A big pack of delicious fruits.', 'price' => 10.00, 'state' => '1', 'category_id' => 4]
    	];
    	DB::table('products')->insert($products);
    }
}
