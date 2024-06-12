<?php

use App\User;
use Illuminate\Database\Seeder;
use Modules\Superadmin\Entities\Role;

class RoleSeeder extends Seeder
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

        

        // $users = User::whereHas('roles', function($query) {
        //     $query->where('name', '!=', Role::ADMIN);
        // })->get();
        
        // foreach($users as $user) {
        //     $user->roles()->detach($user->roles);
        //     $user->assignRole(Role::SUPER_USER);
        // }
    }
}
