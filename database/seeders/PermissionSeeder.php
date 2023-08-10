<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create all permissions
        $this->createPermission();

        // create editor role and assign permissions to it
        $this->createEditorRoleUser();

        // create super admin role and assign permissions to it
        $this->createSuperAdminRoleUser();
    }

    private function createPermission()
    {
        // create collection permissions
        Permission::create(['name' => 'collection.create', 'guard_name' => 'sanctum']);
        Permission::create(['name' => 'collection.read', 'guard_name' => 'sanctum']);
        Permission::create(['name' => 'collection.update', 'guard_name' => 'sanctum']);
        Permission::create(['name' => 'collection.delete', 'guard_name' => 'sanctum']);

        // create singleton permissions
        Permission::create(['name' => 'singleton.create', 'guard_name' => 'sanctum']);
        Permission::create(['name' => 'singleton.read', 'guard_name' => 'sanctum']);
        Permission::create(['name' => 'singleton.update', 'guard_name' => 'sanctum']);
        Permission::create(['name' => 'singleton.delete', 'guard_name' => 'sanctum']);

        // create media permissions
        Permission::create(['name' => 'media.create', 'guard_name' => 'sanctum']);
        Permission::create(['name' => 'media.read', 'guard_name' => 'sanctum']);
        Permission::create(['name' => 'media.update', 'guard_name' => 'sanctum']);
        Permission::create(['name' => 'media.delete', 'guard_name' => 'sanctum']);

        // create user permissions
        Permission::create(['name' => 'user.create', 'guard_name' => 'sanctum']);
        Permission::create(['name' => 'user.read', 'guard_name' => 'sanctum']);
        Permission::create(['name' => 'user.update', 'guard_name' => 'sanctum']);
        Permission::create(['name' => 'user.delete', 'guard_name' => 'sanctum']);

        // create setting permissions
        Permission::create(['name' => 'setting.read', 'guard_name' => 'sanctum']);
        Permission::create(['name' => 'setting.update', 'guard_name' => 'sanctum']);
    }

    private function createEditorRoleUser()
    {
        $roleEditor = Role::create(['name' => 'editor', 'guard_name' => 'sanctum']);
        $roleEditor->givePermissionTo('collection.create');
        $roleEditor->givePermissionTo('collection.read');
        $roleEditor->givePermissionTo('collection.update');
        $roleEditor->givePermissionTo('collection.delete');

        $roleEditor->givePermissionTo('singleton.create');
        $roleEditor->givePermissionTo('singleton.read');
        $roleEditor->givePermissionTo('singleton.update');
        $roleEditor->givePermissionTo('singleton.delete');

        $roleEditor->givePermissionTo('media.create');
        $roleEditor->givePermissionTo('media.read');
        $roleEditor->givePermissionTo('media.update');
        $roleEditor->givePermissionTo('media.delete');

        $user = \App\Models\User::factory()->create([
            'name' => 'Editor User',
            'username' => 'editoruser',
            'email' => 'test@example.com',
            'password' => bcrypt('secret'),
        ]);
        $user->assignRole($roleEditor);
    }

    private function createSuperAdminRoleUser()
    {
        $roleSuperAdmin = Role::create(['name' => 'Super-Admin', 'guard_name' => 'sanctum']);
        $roleSuperAdmin->givePermissionTo(Permission::all());

        $user = \App\Models\User::factory()->create([
            'name' => 'Super-Admin User',
            'username' => 'superadminuser',
            'email' => 'superadmin@example.com',
            'password' => bcrypt('secret'),
        ]);
        $user->assignRole($roleSuperAdmin);

        $appUser = \App\Models\User::factory()->create([
            'name' => 'App User',
            'username' => 'appuser',
            'email' => 'app@example.com',
            'password' => bcrypt('secret'),
        ]);
        $appUser->assignRole($roleSuperAdmin);
    }
}
