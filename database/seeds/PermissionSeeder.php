<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use Modules\Superadmin\Entities\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::$hidden_roles;

        foreach($roles as $value)
        {
            Role::firstOrCreate(
                ['name' => $value]
            );
        }
        
        $permissions = Permission::$list;

        foreach($permissions as $key => $value)
        {
            Permission::firstOrCreate(
                ['name' => $value],
                ['slug' => $key]
            );
        }

        $admin = Role::where('name', Role::ADMIN)->first();
        $adminPermissions = Permission::whereIn('name', Permission::$adminPermissionList)->get()->pluck('id');
        $admin->syncPermissions($adminPermissions);

        $store              = Role::where('name', Role::STORE)->first();
        $storePermissions   = Permission::whereIn('name', Permission::$storePermissionList)->get()->pluck('id');
        $store->syncPermissions($storePermissions);
        
    }
}
