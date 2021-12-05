<?php

use Illuminate\Database\Seeder;

class ComplementsGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $complement_group = [
    		['price' => 0.00, 'state' => '1', 'group_id' => 1, 'complement_id' => 1],
    		['price' => 0.50, 'state' => '1', 'group_id' => 1, 'complement_id' => 2],
    		['price' => 0.00, 'state' => '1', 'group_id' => 1, 'complement_id' => 3],
    		['price' => 1.00, 'state' => '1', 'group_id' => 1, 'complement_id' => 4],
            ['price' => 0.00, 'state' => '1', 'group_id' => 3, 'complement_id' => 5],
            ['price' => 0.50, 'state' => '1', 'group_id' => 3, 'complement_id' => 6],
            ['price' => 0.00, 'state' => '1', 'group_id' => 3, 'complement_id' => 7],
            ['price' => 0.00, 'state' => '1', 'group_id' => 4, 'complement_id' => 1],
            ['price' => 0.00, 'state' => '1', 'group_id' => 4, 'complement_id' => 2],
            ['price' => 0.00, 'state' => '1', 'group_id' => 4, 'complement_id' => 3],
            ['price' => 1.00, 'state' => '1', 'group_id' => 4, 'complement_id' => 4],
            ['price' => 0.00, 'state' => '1', 'group_id' => 4, 'complement_id' => 5],
            ['price' => 0.00, 'state' => '1', 'group_id' => 5, 'complement_id' => 1],
            ['price' => 0.00, 'state' => '1', 'group_id' => 5, 'complement_id' => 2],
            ['price' => 0.00, 'state' => '1', 'group_id' => 5, 'complement_id' => 3],
            ['price' => 0.00, 'state' => '1', 'group_id' => 5, 'complement_id' => 5]
    	];
    	DB::table('complement_group')->insert($complement_group);
    }
}
