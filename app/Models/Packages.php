<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description'
    ];

     public function status()
    {
        return $this->belongsTo('App\Models\AppStatus', 'plan_id', 'id');
    }
    
}
