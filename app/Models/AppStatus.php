<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppStatus extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'type'
    ];

    const STORE         = 'Store';
    const PARTNER       = 'Partner';
    const APP_STATUS    = 'AS';
    const STATUS        = 'ST';

    public static $category = [
        self::STORE,self::PARTNER
    ];

   

}
