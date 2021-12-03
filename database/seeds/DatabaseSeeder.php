<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(AgenciesSeeder::class);
        $this->call(AttributesSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(ComplementsSeeder::class);
        $this->call(GroupsSeeder::class);
        $this->call(ComplementsGroupsSeeder::class);
        $this->call(GroupsProductsSeeder::class);
    }
}
