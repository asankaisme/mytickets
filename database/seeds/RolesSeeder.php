<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'view ticket']);
        Permission::create(['name' => 'add ticket']);
        Permission::create(['name' => 'edit ticket']);
        Permission::create(['name' => 'delete ticket']);
        Permission::create(['name' => 'assign ticket']);
        Permission::create(['name' => 'accept ticket']);
        Permission::create(['name' => 'transfer ticket']);
        Permission::create(['name' => 'manage headers']);
        Permission::create(['name' => 'manage priorities']);
        Permission::create(['name' => 'view sysLog']);
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'print reports']);
        Permission::create(['name' => 'add feedback']);

        // create roles and assign existing permissions
        $client = Role::create(['name' => 'Client']);
        $client->givePermissionTo('view ticket');
        $client->givePermissionTo('add ticket');
        $client->givePermissionTo('edit ticket');
        $client->givePermissionTo('delete ticket');
        $client->givePermissionTo('add feedback');
        $client->givePermissionTo('print reports');

        $coordinator = Role::create(['name' => 'Coordinator']);
        $coordinator->givePermissionTo('view ticket');
        $coordinator->givePermissionTo('assign ticket');
        $coordinator->givePermissionTo('manage headers');
        $coordinator->givePermissionTo('manage priorities');
        $coordinator->givePermissionTo('print reports');

        $supportEng = Role::create(['name' => 'Support Engineer']);
        $supportEng->givePermissionTo('view ticket');
        $supportEng->givePermissionTo('accept ticket');
        $supportEng->givePermissionTo('transfer ticket');

        $l2Eng = Role::create(['name' => 'L2-Engineer']);
        $l2Eng->givePermissionTo('view ticket');
        $l2Eng->givePermissionTo('accept ticket');

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo('view ticket');
        $admin->givePermissionTo('add ticket');
        $admin->givePermissionTo('edit ticket');
        $admin->givePermissionTo('delete ticket');
        $admin->givePermissionTo('assign ticket');
        $admin->givePermissionTo('accept ticket');
        $admin->givePermissionTo('transfer ticket');
        $admin->givePermissionTo('manage headers');
        $admin->givePermissionTo('manage priorities');
        $admin->givePermissionTo('view sysLog');
        $admin->givePermissionTo('manage users');
        $admin->givePermissionTo('print reports');
        $admin->givePermissionTo('add feedback');

        Role::create(['name' => 'super-admin']);

        //create sys admin user
        $user = User::create([
            'name' => 'Sys Admin',
            'email' => 'admin@mytickets.com',
            'password' => Hash::make('asdf1234'),
        ]);
        $user->assignRole($admin);

        $user = User::create([
            'name' => 'asanka rubasinghe',
            'email' => 'asankaisme@mytickets.com',
            'password' => Hash::make('asanka123'),
        ]);
        $user->assignRole($admin);

        //client user
        $user = User::create([
            'name' => 'Client',
            'email' => 'client@mytickets.com',
            'password' => Hash::make('asdf1234'),
        ]);
        $user->assignRole($client);

        $user = User::create([
            'name' => 'Ruwan Sampath',
            'email' => 'ruwan@mytickets.com',
            'password' => Hash::make('asdf1234'),
        ]);
        $user->assignRole($client);

        //coordinator
        $user = User::create([
            'name' => 'Coordinator',
            'email' => 'coordinator@mytickets.com',
            'password' => Hash::make('asdf1234'),
        ]);
        $user->assignRole($coordinator);

        $user = User::create([
            'name' => 'Janaka Perera',
            'email' => 'janaka@mytickets.com',
            'password' => Hash::make('asdf1234'),
        ]);
        $user->assignRole($coordinator);

        //support engineer
        $user = User::create([
            'name' => 'Support Engineers',
            'email' => 'supportengineer@mytickets.com',
            'password' => Hash::make('asdf1234'),
        ]);
        $user->assignRole($supportEng);

        //support engineer
        $user = User::create([
            'name' => 'Sudesh Ranasinghe',
            'email' => 'sudesh@mytickets.com',
            'password' => Hash::make('asdf1234'),
        ]);
        $user->assignRole($supportEng);

        //Level 2 Engineer
        $user = User::create([
            'name' => 'L2 Engineer',
            'email' => 'l2engineer@mytickets.com',
            'password' => Hash::make('asdf1234'),
        ]);
        $user->assignRole($l2Eng);
    }
}
