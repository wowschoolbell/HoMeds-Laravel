<?php

namespace Modules\Superadmin\Entities;

// use App\Traits\Base;

class Role extends \Spatie\Permission\Models\Role
{
    // use Base;

    public $incrementing = false;

    protected $fillable = [
        'name',
        'guard_name',
        'is_hidden'
    ];

    // Roles
    const ADMIN         = 'admin';
    const STORE         = 'Store';

    public static $hidden_roles = ['admin', 'Store'];

}
