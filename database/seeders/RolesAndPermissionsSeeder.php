<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $employeeRole = Role::create(['name' => 'employee']);
        $customerRole = Role::create(['name' => 'customer']);

        // Create permissions
        $permissions = [
            'createCard',
            'enableProxyFeatures',
            'sendReqSeparateMobile',
            'sendingDSL',
            'sendReqGasBalance',
            'mangSer&PriceBalance',
            'processReqSeparateMobile',
            'processReqGasBalance',
            'processingDSL',
            'customerAccountStatement',
            'websiteAdministration',
        ];

        foreach ($permissions as $permissionName) {
            Permission::create(['name' => $permissionName]);
        }

        // Assign permissions to roles
        $adminRole->syncPermissions($permissions);
        $employeeRole->syncPermissions([
            'createCard',
            'enableProxyFeatures',
            'mangSer&PriceBalance',
            'processReqSeparateMobile',
            'processReqGasBalance',
            'processingDSL',
            'customerAccountStatement',
            'websiteAdministration',
        ]);
        $customerRole->syncPermissions([
            'createCard',
            'enableProxyFeatures',
            'sendReqSeparateMobile',
            'sendReqGasBalance',
            'sendingDSL',
        ]);
    }
}