<?php
namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\PermissionRegistrar;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {

            app()[PermissionRegistrar::class]->forgetCachedPermissions();

            Schema::disableForeignKeyConstraints();

            DB::table('roles')->truncate();

            // Seed the default permissions
            $defaultRoles = Role::DEFAULT_ROLE;
            if (empty($defaultRoles)) {
                $this->command->warn('No Default roles Found.');
            } else {
                foreach ($defaultRoles as $defaultRole) {
                    $role = Role::firstOrCreate([
                        'name' => $defaultRole,
                        'guard_name' => 'admin',
                    ]);
                    if ($defaultRole == Role::DEFAULT_ROLE_SUPER_ADMIN) {
                        $permissions = Permission::pluck('name')->toArray();
                        $this->command->info($defaultRole . '-' . 'permission count: ' . count($permissions));
                        $role->syncPermissions($permissions);
                    }
                }

                $this->command->info('Default roles added successfully.');
            }

            Schema::enableForeignKeyConstraints();

            $this->command->line('------------------------------------------------------------------------------');
        }
    }
}
