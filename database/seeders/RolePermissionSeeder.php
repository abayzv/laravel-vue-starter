<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generate Role
        $roleSuperadmin = Role::create(['name' => 'superadmin']);
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleDriver = Role::create(['name' => 'driver']);

        // Generate Permissions
        // User Permissions
        $userView = Permission::create(['name' => 'view user'])->givePermissionTo($roleAdmin);
        $userCreate = Permission::create(['name' => 'create user'])->givePermissionTo($roleAdmin);
        $userEdit = Permission::create(['name' => 'edit user'])->givePermissionTo($roleAdmin);
        $userDelete = Permission::create(['name' => 'delete user'])->givePermissionTo($roleAdmin);
        // Outlet Permissions
        $outletView = Permission::create(['name' => 'view outlet'])->givePermissionTo($roleAdmin);
        $outletCreate = Permission::create(['name' => 'create outlet'])->givePermissionTo($roleAdmin);
        $outletEdit = Permission::create(['name' => 'edit outlet'])->givePermissionTo($roleAdmin);
        $outletDelete = Permission::create(['name' => 'delete outlet'])->givePermissionTo($roleAdmin);
        // Vehicle Permissions
        $vehicleView = Permission::create(['name' => 'view vehicle'])->givePermissionTo($roleAdmin);
        $vehicleCreate = Permission::create(['name' => 'create vehicle'])->givePermissionTo($roleAdmin);
        $vehicleEdit = Permission::create(['name' => 'edit vehicle'])->givePermissionTo($roleAdmin);
        $vehicleDelete = Permission::create(['name' => 'delete vehicle'])->givePermissionTo($roleAdmin);
        // Trip Permissions
        $tripView = Permission::create(['name' => 'view trip'])->givePermissionTo([$roleAdmin, $roleDriver]);
        $tripCreate = Permission::create(['name' => 'create trip'])->givePermissionTo([$roleAdmin, $roleDriver]);
        $tripEdit = Permission::create(['name' => 'edit trip'])->givePermissionTo($roleAdmin);
        $tripDelete = Permission::create(['name' => 'delete trip'])->givePermissionTo($roleAdmin);
        // TripEntry Permissions
        $tripEntryView = Permission::create(['name' => 'view trip entry'])->givePermissionTo([$roleAdmin, $roleDriver]);
        $tripEntryCreate = Permission::create(['name' => 'create trip entry'])->givePermissionTo([$roleAdmin, $roleDriver]);
        $tripEntryEdit = Permission::create(['name' => 'edit trip entry'])->givePermissionTo($roleAdmin);
        $tripEntryDelete = Permission::create(['name' => 'delete trip entry'])->givePermissionTo($roleAdmin);
        // Report Permissions
        $reportView = Permission::create(['name' => 'view report'])->givePermissionTo($roleAdmin);

        // User::factory(10)->create();
        $superadmin = User::factory()->create([
            'name' => 'Superadmin',
            'email' => 'superadmin@admin.com',
            'password' => 'superadmin@789'
        ]);

        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => 'P@ssw0rd'
        ]);

        $driver1 = User::factory()->create([
            'name' => 'Driver 1',
            'email' => 'driver1@driver.com',
            'password' => 'driver123'
        ]);

        $driver2 = User::factory()->create([
            'name' => 'Driver 2',
            'email' => 'driver2@driver.com',
            'password' => 'driver123'
        ]);

        $driver3 = User::factory()->create([
            'name' => 'Driver 3',
            'email' => 'driver3@driver.com',
            'password' => 'driver123'
        ]);

        $superadmin->assignRole('superadmin');
        $admin->assignRole('admin');
        $driver1->assignRole('driver');
        $driver2->assignRole('driver');
        $driver3->assignRole('driver');
    }
}
