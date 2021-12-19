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
        Permission::create(['name' => 'products.assign.groups']);

        // Complements Permissions
        Permission::create(['name' => 'complements.index']);
        Permission::create(['name' => 'complements.create']);
        Permission::create(['name' => 'complements.show']);
        Permission::create(['name' => 'complements.edit']);
        Permission::create(['name' => 'complements.delete']);
        Permission::create(['name' => 'complements.active']);
        Permission::create(['name' => 'complements.deactive']);

        // Groups Permissions
        Permission::create(['name' => 'groups.index']);
        Permission::create(['name' => 'groups.create']);
        Permission::create(['name' => 'groups.show']);
        Permission::create(['name' => 'groups.edit']);
        Permission::create(['name' => 'groups.delete']);
        Permission::create(['name' => 'groups.active']);
        Permission::create(['name' => 'groups.deactive']);
        Permission::create(['name' => 'groups.assign.complements']);

        // Orders Permissions
        Permission::create(['name' => 'orders.index']);
        Permission::create(['name' => 'orders.show']);
        Permission::create(['name' => 'orders.confirmed']);
        Permission::create(['name' => 'orders.rejected']);

        // Agency Permissions
        Permission::create(['name' => 'agencies.index']);
        Permission::create(['name' => 'agencies.create']);
        Permission::create(['name' => 'agencies.show']);
        Permission::create(['name' => 'agencies.edit']);
        Permission::create(['name' => 'agencies.delete']);
        Permission::create(['name' => 'agencies.active']);
        Permission::create(['name' => 'agencies.deactive']);

        // Attribute Permissions
        Permission::create(['name' => 'attributes.index']);
        Permission::create(['name' => 'attributes.create']);
        Permission::create(['name' => 'attributes.show']);
        Permission::create(['name' => 'attributes.edit']);
        Permission::create(['name' => 'attributes.delete']);
        Permission::create(['name' => 'attributes.active']);
        Permission::create(['name' => 'attributes.deactive']);

        // Currency Permissions
        Permission::create(['name' => 'currencies.index']);
        Permission::create(['name' => 'currencies.create']);
        Permission::create(['name' => 'currencies.show']);
        Permission::create(['name' => 'currencies.edit']);
        Permission::create(['name' => 'currencies.delete']);
        Permission::create(['name' => 'currencies.active']);
        Permission::create(['name' => 'currencies.deactive']);

        // Setting Permissions
        Permission::create(['name' => 'settings.index']);
        Permission::create(['name' => 'settings.edit']);

    	$superadmin=Role::create(['name' => 'Super Admin']);
        $superadmin->givePermissionTo(Permission::all());
        
        $admin=Role::create(['name' => 'Administrador']);
        $admin->givePermissionTo(Permission::all());

        $customer=Role::create(['name' => 'Cliente']);

    	$user=User::find(1);
    	$user->assignRole('Super Admin');

        $users=User::where('id', '!=', 1)->get();
        foreach ($users as $user) {
            $user->assignRole('Cliente');
        }
    }
}
