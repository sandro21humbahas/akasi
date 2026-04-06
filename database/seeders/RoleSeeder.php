<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        if (class_exists('Spatie\Permission\Models\Permission')) {
            app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

            \Spatie\Permission\Models\Permission::create(['name' => 'manage-rooms']);
            \Spatie\Permission\Models\Permission::create(['name' => 'manage-bookings']);
            \Spatie\Permission\Models\Permission::create(['name' => 'view-reports']);

            $adminRole = \Spatie\Permission\Models\Role::create(['name' => 'admin']);
            $adminRole->givePermissionTo(\Spatie\Permission\Models\Permission::all());

            $userRole = \Spatie\Permission\Models\Role::create(['name' => 'user']);

            \App\Models\User::first()?->assignRole('user');
        }
    }
}

