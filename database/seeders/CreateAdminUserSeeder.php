<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Michael Chukwu',
            'email' => 'naemugo@gmail.com',
            'password' => bcrypt('loveth24')
        ]);
        Service::create(['title' => 'Product Standard']);
        $role = Role::create(['name' => 'Admin']);
        $role = Role::create(['name' => 'User']);
        $role = Role::create(['name' => 'HOD']);
        $role = Role::create(['name' => 'Agent']);
        $role = Role::create(['name' => 'Editor']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole(['Admin']);
    }
}
