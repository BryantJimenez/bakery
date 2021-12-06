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
    		['name' => 'Naranja', 'slug' => 'naranja', 'image' => 'orange.jpg', 'description' => 'Jugo de naranja.', 'price' => 0.00, 'state' => '1'],
    		['name' => 'Sandía', 'slug' => 'sandia', 'image' => 'watermelon.jfif', 'description' => 'Jugo con sabor a sandía.', 'price' => 0.50, 'state' => '1'],
    		['name' => 'Fresa', 'slug' => 'fresa', 'image' => 'strawberry.jpg', 'description' => 'Jugo con sabor a fresa.', 'price' => 0.00, 'state' => '1'],
    		['name' => 'Zanahoria con Naranja', 'slug' => 'zanahoria-con-naranja', 'image' => 'carrot-with-orange.jpeg', 'description' => 'Zumo de zanahoria con naranja.', 'price' => 1.00, 'state' => '1'],
            ['name' => 'Tomate', 'slug' => 'tomate', 'image' => 'tomato.jpg', 'description' => 'Fruto de esta planta, comestible, con piel roja, tersa y brillante, pulpa muy jugosa.', 'price' => 0.00, 'state' => '1'],
            ['name' => 'Mantequilla', 'slug' => 'mantequilla', 'image' => 'butter.jpg', 'description' => 'Grasa comestible de consistencia blanda, color amarillento y sabor suave.', 'price' => 0.00, 'state' => '1'],
            ['name' => 'Aceite', 'slug' => 'aceite', 'image' => 'oil.jpg', 'description' => 'Aceite obtenido de aceitunas y utilizado principalmente como condimento.', 'price' => 0.00, 'state' => '1']
    	];
    	DB::table('complements')->insert($complements);
    }
}
