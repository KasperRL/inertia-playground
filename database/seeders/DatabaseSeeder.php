<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(100)->create();

        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@x.y',
            'password' => 'admin'
        ]);

        $temp = User::create([
            'name' => 'temp',
            'email' => 'temp@temp.nl',
            'password' => 'temp123',
        ]);

        $addUsers = Permission::create(['name' => 'add users']);
        $editUsers = Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'assign roles']);

        $levelOne = Role::create(['name' => 'level-one-access']);
        $levelTwo = Role::create(['name' => 'level-two-access']);
        Role::create(['name' => 'super-admin']);

        $admin->assignRole('super-admin');
        $temp->assignRole('level-one-access');
        
        $editUsers->syncRoles([$levelOne, $levelTwo]);
        $addUsers->syncRoles([$levelTwo]);
    }
}