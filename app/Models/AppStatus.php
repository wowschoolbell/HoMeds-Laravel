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
        'name'
    ];

    const STORE     = 'Store';
    const PARTNER   = 'Partner';

    public static $category = [
        self::STORE,self::PARTNER
    ];

}
