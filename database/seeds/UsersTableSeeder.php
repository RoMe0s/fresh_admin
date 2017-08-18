<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'     => 'admin',
            'email'    => 'admin@admin.com',
            'password' => 'admin',
        ]);


        $role = Role::create(['name' => 'Administrator']);

        Permission::create(['name' => 'administrator']);

        $role->givePermissionTo('administrator');

        $user->assignRole('Administrator');

    }
}
