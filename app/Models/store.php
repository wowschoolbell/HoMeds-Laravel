<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class store extends Model
{
    use HasFactory;
    
    
    protected $primaryKey = 'id';
    
    protected $fillable = [
       'id', 'name', 'contact_person_name', 'phone', 'mobile_number', 'email', 'gst_number',
        'drug_licence', 'address', 'area', 'state', 'city',"pincode","store_image","store_logo","bank_name","bank_account_number","ifsc_code","app_status","status"
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    
    
    
}
