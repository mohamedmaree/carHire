<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\PermissionRegistrar;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultPermissions = Permission::defaultPermissions();
        Schema::disableForeignKeyConstraints();

        foreach ($defaultPermissions as $perm) {
            Permission::firstOrCreate($perm);
        }
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $admin = Admin::first();
        $permissions = Permission::where('guard_name', 'admin')->get();
        $role = Role::first();
        $role->syncPermissions($permissions);
        $admin->assignRole($role);

        /*    $admins = Admin::get();
            foreach ($admins as $a)
            {
                $a->assignRole($role);
            }*/
        Schema::enableForeignKeyConstraints();
    }
}
