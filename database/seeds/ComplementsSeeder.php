<?php

use Illuminate\Database\Seeder;

class ComplementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $complements = [
    		['name' => 'Orange', 'slug' => 'orange', 'image' => 'orange.jpg', 'description' => 'Orange flavor juice.', 'price' => 0.00, 'state' => '1'],
    		['name' => 'Watermelon', 'slug' => 'watermelon', 'image' => 'watermelon.jfif', 'description' => 'Watermelon flavored juice.', 'price' => 0.50, 'state' => '1'],
    		['name' => 'Strawberry', 'slug' => 'strawberry', 'image' => 'strawberry.jpg', 'description' => 'Strawberry flavored juice.', 'price' => 0.00, 'state' => '1'],
    		['name' => 'Carrot with Orange', 'slug' => 'carrot-with-orange', 'image' => 'carrot-with-orange.jpeg', 'description' => 'Carrot flavored juice with orange.', 'price' => 1.00, 'state' => '1']
    	];
    	DB::table('complements')->insert($complements);
    }
}
