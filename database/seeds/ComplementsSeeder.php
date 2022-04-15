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
    		['name' => '{"es": "Naranja", "en": "Orange"}', 'slug' => 'naranja', 'image' => 'orange.jpg', 'description' => '{"es": "Jugo de naranja.", "en": "Orange juice."}', 'price' => 0.00, 'state' => '1'],
    		['name' => '{"es": "Sandía", "en": "Watermelon"}', 'slug' => 'sandia', 'image' => 'watermelon.jfif', 'description' => '{"es": "Jugo con sabor a sandía.", "en": "Watermelon flavored juice."}', 'price' => 0.50, 'state' => '1'],
    		['name' => '{"es": "Fresa", "en": "Strawberry"}', 'slug' => 'fresa', 'image' => 'strawberry.jpg', 'description' => '{"es": "Jugo con sabor a fresa.", "en": "Strawberry flavored juice."}', 'price' => 0.00, 'state' => '1'],
    		['name' => '{"es": "Zanahoria con Naranja", "en": "Carrot with Orange"}', 'slug' => 'zanahoria-con-naranja', 'image' => 'carrot-with-orange.jpeg', 'description' => '{"es": "Zumo de zanahoria con naranja.", "en": "Carrot juice with orange."}', 'price' => 1.00, 'state' => '1'],
            ['name' => '{"es": "Tomate", "en": "Tomato"}', 'slug' => 'tomate', 'image' => 'tomato.jpg', 'description' => '{"es": "Fruto de esta planta, comestible, con piel roja, tersa y brillante, pulpa muy jugosa.", "en": "Fruit of this plant, edible, with red, smooth and shiny skin, very juicy pulp."}', 'price' => 0.00, 'state' => '1'],
            ['name' => '{"es": "Mantequilla", "en": "Butter"}', 'slug' => 'mantequilla', 'image' => 'butter.jpg', 'description' => '{"es": "Grasa comestible de consistencia blanda, color amarillento y sabor suave.", "en": "Edible fat with a soft consistency, yellowish color and mild flavor."}', 'price' => 0.00, 'state' => '1'],
            ['name' => '{"es": "Aceite", "en": "Oil"}', 'slug' => 'aceite', 'image' => 'oil.jpg', 'description' => '{"es": "Aceite obtenido de aceitunas y utilizado principalmente como condimento.", "en": "Oil obtained from olives and used mainly as a condiment."}', 'price' => 0.00, 'state' => '1']
    	];
    	DB::table('complements')->insert($complements);
    }
}
