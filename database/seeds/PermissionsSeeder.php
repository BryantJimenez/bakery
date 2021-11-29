<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Permission to Access the Administrative Panel
        Permission::create(['name' => 'dashboard']);

        // User Permissions
        Permission::create(['name' => 'users.index']);
        Permission::create(['name' => 'users.create']);
        Permission::create(['name' => 'users.show']);
        Permission::create(['name' => 'users.edit']);
        Permission::create(['name' => 'users.delete']);
        Permission::create(['name' => 'users.active']);
        Permission::create(['name' => 'users.deactive']);

        // Customer Permissions
        Permission::create(['name' => 'customers.index']);
        Permission::create(['name' => 'customers.create']);
        Permission::create(['name' => 'customers.show']);
        Permission::create(['name' => 'customers.edit']);
        Permission::create(['name' => 'customers.delete']);
        Permission::create(['name' => 'customers.active']);
        Permission::create(['name' => 'customers.deactive']);

        // Category Permissions
        Permission::create(['name' => 'categories.index']);
        Permission::create(['name' => 'categories.create']);
        Permission::create(['name' => 'categories.show']);
        Permission::create(['name' => 'categories.edit']);
        Permission::create(['name' => 'categories.delete']);
        Permission::create(['name' => 'categories.active']);
        Permission::create(['name' => 'categories.deactive']);

        // Product Permissions
        Permission::create(['name' => 'products.index']);
        Permission::create(['name' => 'products.create']);
        Permission::create(['name' => 'products.show']);
        Permission::create(['name' => 'products.edit']);
        Permission::create(['name' => 'products.delete']);
        Permission::create(['name' => 'products.active']);
        Permission::create(['name' => 'products.deactive']);

        // Agency Permissions
        Permission::create(['name' => 'agencies.index']);
        Permission::create(['name' => 'agencies.create']);
        Permission::create(['name' => 'agencies.show']);
        Permission::create(['name' => 'agencies.edit']);
        Permission::create(['name' => 'agencies.delete']);
        Permission::create(['name' => 'agencies.active']);
        Permission::create(['name' => 'agencies.deactive']);

    	$superadmin=Role::create(['name' => 'Super Admin']);
        $superadmin->givePermissionTo(Permission::all());
        
        $admin=Role::create(['name' => 'Administrator']);
        $admin->givePermissionTo(Permission::all());

        $customer=Role::create(['name' => 'Customer']);

    	$user=User::find(1);
    	$user->assignRole('Super Admin');

        $users=User::where('id', '!=', 1)->get();
        foreach ($users as $user) {
            $user->assignRole('Customer');
        }
    }
}
