<?php

namespace App\Helpers;

use Modules\Superadmin\Entities\Role;

class SecurityHelper
{
    public static function hasAccess($routes)
    {

        $user = \Auth::user();

        $roles = $user->allRoles();

        if(!$user){
            return false;
        }

        if(is_array($routes)) {
            foreach($routes  as $route){
                if($user->can($route) == true){
                    return true;
                }
            }
            return false;
        }else{
            // Single permission checking
            return $user->can($routes);
        }
    }
}
