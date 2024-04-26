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
        'phone', 'aadhar', 'aadhar_image', 'driving_licence', 'driving_licence_image',
        'address', 'area', 'state', 'city',	'pincode', 'bank_name', 'bank_account_number',
        'ifsc', 'area_mapping_state', 'area_mapping_area', 'area_mapping_city', 'area_mapping_pincode'
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
