<?php

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\Superadmin\Entities\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        
        $user = User::firstOrCreate([
            'email'    => 'admin@admin.com',
        ],[
            'name'     => 'Admin',
            'password' => Hash::make('123456'),
        ]);

        $user->syncRoles([Role::ADMIN]);
    }
}
