<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $superadmin = User::factory()->create([
            'name' => 'Superadmin',
            'email' => 'superadmin@admin.com',
            'password' => 'superadmin@789'
        ]);

        $user1 = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => 'P@ssw0rd'
        ]);

        $user2 = User::factory()->create([
            'name' => 'Driver 1',
            'email' => 'driver1@driver.com',
            'password' => 'driver123'
        ]);

        $role1 = Role::create(['name' => 'superadmin']);
        $role1 = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'driver']);
        $permission1 = Permission::create(['name' => 'view dashboard']);
        $permission2 = Permission::create(['name' => 'create trips']);

        $permission1->givePermissionTo(($role1));
        $permission2->givePermissionTo(($role2));

        $superadmin->assignRole('superadmin');
        $user1->assignRole('admin');
        $user2->assignRole('driver');
    }
}
