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
    		['name' => 'Refresco', 'slug' => 'refresco', 'description' => 'Bebida carbonatada, es una bebida saborizada, hecha con agua carbonatada y edulcorantes naturales.', 'price' => 1.90, 'state' => '1', 'category_id' => 1],
    		['name' => 'Agua', 'slug' => 'agua', 'description' => 'Bebida natural fria.', 'price' => 1.90, 'state' => '1', 'category_id' => 1],
    		['name' => 'Zumo', 'slug' => 'zumo', 'description' => 'Jugo que se obtiene al exprimir una fruta.', 'price' => 1.90, 'state' => '1', 'category_id' => 1],
    		['name' => 'Cacaolat', 'slug' => 'cacaolat', 'description' => 'Bebida chocolatada a base de cacao.', 'price' => 2.20, 'state' => '1', 'category_id' => 1]
    	];
    	DB::table('products')->insert($products);
    }
}
