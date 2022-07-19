<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'create workshops']);
        Permission::create(['name' => 'edit workshops']);
        Permission::create(['name' => 'delete workshops']);
        Permission::create(['name' => 'publish workshops']);
        Permission::create(['name' => 'cancel workshops']);
        Permission::create(['name' => 'view workshops']);

        Permission::create(['name' => 'create clients']);
        Permission::create(['name' => 'edit clients']);
        Permission::create(['name' => 'delete clients']);
        Permission::create(['name' => 'view clients']);

        Permission::create(['name' => 'create companies']);
        Permission::create(['name' => 'edit companies']);
        Permission::create(['name' => 'delete companies']);
        Permission::create(['name' => 'view companies']);

        Permission::create(['name' => 'create trainers']);
        Permission::create(['name' => 'edit trainers']);
        Permission::create(['name' => 'delete trainers']);
        Permission::create(['name' => 'view trainers']);

        Permission::create(['name' => 'create contacts']);
        Permission::create(['name' => 'edit contacts']);
        Permission::create(['name' => 'delete contacts']);
        Permission::create(['name' => 'view contacts']);

        Permission::create(['name' => 'create locations']);
        Permission::create(['name' => 'edit locations']);
        Permission::create(['name' => 'delete locations']);
        Permission::create(['name' => 'view locations']);

        Permission::create(['name' => 'create']);
        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'delete']);
        Permission::create(['name' => 'view']);
        Permission::create(['name' => 'import']);

        // create seller permissions
        Permission::create(['name' => 'create offers']);
        Permission::create(['name' => 'edit offers']);
        Permission::create(['name' => 'delete offers']);
        Permission::create(['name' => 'view offers']);

        // create controller permissions
        Permission::create(['name' => 'create invoices']);
        Permission::create(['name' => 'delete invoices']);
        Permission::create(['name' => 'view invoices']);

        // create admin permissions
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'view users']);

        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'edit roles']);
        Permission::create(['name' => 'delete roles']);
        Permission::create(['name' => 'view roles']);

        Permission::create(['name' => 'view logs']);
        Permission::create(['name' => 'export']);
        Permission::create(['name' => 'edit admin']);


        // create user roles and assign permissions

        $role1 = Role::create(['name' => 'editor']);
        $role1->givePermissionTo('create');
        $role1->givePermissionTo('edit');
        $role1->givePermissionTo('view');



        $role3 = Role::create(['name' => 'seller']);
        $role3->givePermissionTo('create');
        $role3->givePermissionTo('view');

        $role4 = Role::create(['name' => 'supervisor']);
        $role4->givePermissionTo('publish workshops');
        $role4->givePermissionTo('cancel workshops');
        $role4->givePermissionTo('view logs');
        $role4->givePermissionTo('export');
        $role4->givePermissionTo('import');
        $role4->givePermissionTo('create');
        $role4->givePermissionTo('edit');
        $role4->givePermissionTo('delete');
        $role4->givePermissionTo('view');


        //
        $role6 = Role::create(['name' => 'super-admin']);
        $role6->givePermissionTo(Permission::all());
        $admin = User::whereId(1)->firstOrFail();
        $admin->assignRole('super-admin');
    }
}
