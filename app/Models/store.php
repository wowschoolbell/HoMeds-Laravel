<?php

namespace App\Models;

use App\Helpers\StorageHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class store extends Model
{
    use HasFactory;
    
    
    protected $primaryKey = 'id';
    
    protected $fillable = [
       'id', 'user_id', 'name', 'contact_person_name', 'phone', 'mobile_number', 'email', 'gst_number',
        'drug_licence', 'address', 'city_id',"store_image","store_logo","bank_name","bank_account_number","ifsc_code","app_status_id","status_id"
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function appStatus()
    {
        return $this->belongsTo(AppStatus::class, 'app_status_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\AppStatus', 'status_id', 'id');
    }

    

    /**
     * 
     */
    public function getStoreimageAttribute($value)
    {
        return ($value) ? StorageHelper::getFileUrl($value) : asset('theme/light/img/default_user.png');
    }

    public function getStorelogoAttribute($value)
    {
        return ($value) ? StorageHelper::getFileUrl($value) : asset('theme/light/img/default_user.png');
    }


    
}
