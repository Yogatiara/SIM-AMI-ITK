<?php

namespace Database\Seeders;

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
        // Create roles
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'PJM']);
        Role::create(['name' => 'Auditee']);
        Role::create(['name' => 'Auditor']);

        // Create permissions
        Permission::create(['name' => 'manage roles']);
        Permission::create(['name' => 'manage permissions']);
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'manage documents']);
        Permission::create(['name' => 'manage forms']);
        Permission::create(['name' => 'manage stages']);
        Permission::create(['name' => 'manage faculties']);
        Permission::create(['name' => 'view reports']);

        // Assign permissions to Admin role
        $adminRole = Role::findByName('Admin');
        $adminRole->givePermissionTo(Permission::all());

        // Assign permissions to PJM role
        $pjmRole = Role::findByName('PJM');
        $pjmRole->givePermissionTo(['manage documents', 'manage forms', 'manage stages', 'manage faculties', 'view reports']);
    }
}
