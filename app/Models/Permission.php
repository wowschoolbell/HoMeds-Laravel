<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends \Spatie\Permission\Models\Permission
{
    public $incrementing = false;

    protected $fillable = [
        'name',
        'slug',
        'guard_name'
    ];

    public static $adminPermissionList = [
        'configurations.index', 'states.index', 'states.create', 'states.edit', 'states.delete',
        'cities.index', 'cities.create', 'cities.edit', 'cities.delete', 'store.index', 'store.create',
        'store.edit', 'store.delete', 'delivery_partner.index', 'delivery_partner.create', 'delivery_partner.edit',
        'delivery_partner.delete', 'customers.index', 'customers.create', 'customers.edit', 'customers.delete'
    ];

    public static $storePermissionList = [
        'configurations.index', 'states.index', 'states.create', 'states.edit', 'states.delete',
        'cities.index', 'cities.create', 'cities.edit', 'cities.delete',
        'customers.index', 'customers.create', 'customers.edit', 'customers.delete',
    ];


    public static $list = [

        'Configurations'    => 'configurations.index',

        'State.view'        => 'states.index',
        'State.create'      => 'states.create',
        'State.edit'        => 'states.edit',
        'State.delete'      => 'states.delete',

        'City.view'         => 'cities.index',
        'City.create'       => 'cities.create',
        'City.edit'         => 'cities.edit',
        'City.delete'       => 'cities.delete',

        'Store.view'        => 'store.index',
        'Store.create'      => 'store.create',
        'Store.edit'        => 'store.edit',
        'Store.delete'      => 'store.delete',

        'Pilot.view'        => 'delivery_partner.index', 
        'Pilot.create'      => 'delivery_partner.create',
        'Pilot.edit'        => 'delivery_partner.edit',
        'Pilot.delete'      => 'delivery_partner.delete',

        'Customer.view'     => 'customers.index', 
        'Customer.create'   => 'customers.create',
        'Customer.edit'     => 'customers.edit',
        'Customer.delete'   => 'customers.delete',
    ];
    // Disable the labels depend upons the role & permissions
    // public static function disableLabel($route){
    //     return SecurityHelper::hasAccess($route) ? '' : 'disabled';
    // }

}
