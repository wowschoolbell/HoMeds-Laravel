<?php

namespace App\Models;

use App\Helpers\StorageHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryPartner extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id', 'app_statuses_id', 'first_name', 'middle_name', 'last_name', 'photo',
        'phone', 'aadhar', 'aadhar_image', 'aadhar_front_image', 'aadhar_back_image',
        'driving_licence', 'driving_licence_front_image', 'driving_licence_back_image',
        'pan', 'gender', 'address', 'city_id', 'bank_name', 'bank_acc_number', 'pan_image',
        'ifsc', 'drop_city_id'
    ];

    /**
     * 
     */
    public function getPhotoAttribute($value)
    {
        return ($value) ? StorageHelper::getFileUrl($value) : asset('theme/light/img/default_user.png');
    }

    /**
     * 
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
