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

        $addUsers = Permission::create(['name' => 'add users']);
        $editUsers = Permission::create(['name' => 'edit users']);
        $deleteUsers = Permission::create(['name' => 'delete users']);

        $levelOne = Role::create(['name' => 'level-one-access']);
        $levelTwo = Role::create(['name' => 'level-two-access']);
        Role::create(['name' => 'super-admin']);

        $addUsers->syncRoles([$levelOne, $levelTwo]);
        $deleteUsers->syncRoles([$levelTwo]);
    }
}