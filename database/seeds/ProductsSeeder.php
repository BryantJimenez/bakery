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
    		['name' => 'Cacaolat', 'slug' => 'cacaolat', 'image' => 'cacaolat.jfif', 'description' => 'Cocoa-based chocolate drink.', 'price' => 2.20, 'state' => '1', 'category_id' => 1]
    	];
    	DB::table('products')->insert($products);
    }
}
