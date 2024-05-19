<?php

namespace App;

use Carbon\Carbon;
use Cohensive\Embed\Facades\Embed;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'phone', 'password',
    ];

    public static $gender =  ['M' =>'Male','F' => 'Female'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * 
     */
    public static function generateRandomString() {
        $length = 10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString.Carbon::now()->format('dmYHsi');
    }

    /**
     * 
     */
    public function allRoles()
    {
        return @$this->roles()->pluck('name')->toArray();
    }

    /**
     * 
     */
    public static function embedUrlLink($url)
    {
        if(strlen($url) > 11)
        {
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match))
            {
                return "http://www.youtube.com/embed/".$match[1];
            }
        }

        return $url;
    }

    /**
     * 
     */
    public function delivery_partner()
    {
        return $this->hasOne('App\Models\DeliveryPartner');
    }

    /**
     * 
     */
    public function store()
    {
        return $this->hasOne('App\Models\Store');
    }
}
