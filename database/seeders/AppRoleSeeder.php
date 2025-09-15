<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AppRoleSeeder extends Seeder
{
    public function run(): void
    {
        $roleAdmin = Role::create(['name' => 'Sistem Yöneticisi']); // Admin
        $roleClient = Role::create(['name' => 'İşletme Yöneticisi']); // Client

        $permission_01 = Permission::create(['name' => 'Müşteri Yönetimi Kullanım İzni']); // Admin
        $permission_02 = Permission::create(['name' => 'Dijital Menü Yönetimi Kullanım İzni']); // Client
        $permission_09 = Permission::create(['name' => 'Dijital Menü Ayarlarını Kullanım İzni']); // Client
        $permission_10 = Permission::create(['name' => 'Sistem Ayarlarını Kullanım İzni']); // Admin

        $roleAdmin->givePermissionTo(
            $permission_01,
            $permission_10
        );

        $roleClient->givePermissionTo(
            $permission_02,
            $permission_09
        );
    }
}
