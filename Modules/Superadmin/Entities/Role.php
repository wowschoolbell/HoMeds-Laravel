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
    const EDITOR        = 'editor';
    const SUPER_USER    = 'Super user';
    const Viewer        = 'Viewer';

    public static $hidden_roles = ['admin', 'Super user', 'Viewer', 'Delivery Partner'];

}
