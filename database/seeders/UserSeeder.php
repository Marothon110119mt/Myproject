<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        Permission::create(['name' => 'add product']);
        Permission::create(['name' => 'edit product']);
        Permission::create(['name' => 'delete product']);

        $role1 = Role::create(['name' => 'owner']);
        $role1->givePermissionTo('add product');
        $role1->givePermissionTo('edit product');
        $role1->givePermissionTo('delete product');

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('add product');
        $role2->givePermissionTo('edit product');
        $role2->givePermissionTo('delete product');

        $role2 = Role::create(['name' => 'staff']);
        $role2->givePermissionTo('add product');
        $role2->givePermissionTo('edit product');
        $role2->givePermissionTo('delete product');

        $role2 = Role::create(['name' => 'general_manager']);
        $role2->givePermissionTo('add product');
        $role2->givePermissionTo('edit product');
        $role2->givePermissionTo('delete product');
        User::create([
            'name' => 'owner',
            'email' => 'owner@gmail.com',
            'phone' => '0968877203',
            'status' => '1',
            'email_verified_at' => now(),
            'password' => bcrypt('123456')
        ])->assignRole('owner');
      
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '0968877203',
            'status' => '1',
            'email_verified_at' => now(),
            'password' => bcrypt('123456')
        ])->assignRole('admin');
      
        User::create([
            'name' => 'staff',
            'email' => 'staff@gmail.com',
            'phone' => '0968877203',
            'status' => '1',
            'email_verified_at' => now(),
            'password' => bcrypt('123456')
        ])->assignRole('staff');
        User::create([
            'name' => 'general_manager',
            'email' => 'general_manager@gmail.com',
            'phone' => '0968877203',
            'status' => '1',
            'email_verified_at' => now(),
            'password' => bcrypt('123456')
        ])->assignRole('general_manager');
    }
}
