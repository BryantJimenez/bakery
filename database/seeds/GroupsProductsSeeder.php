<?php

use Illuminate\Database\Seeder;

class GroupsProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group_product = [
    		['product_id' => 3, 'group_id' => 1],
    		['product_id' => 5, 'group_id' => 3],
            ['product_id' => 6, 'group_id' => 1],
            ['product_id' => 6, 'group_id' => 4],
            ['product_id' => 7, 'group_id' => 5]
    	];
    	DB::table('group_product')->insert($group_product);
    }
}
