<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{

    protected $fillable = [
        'name'
    ];

    use HasFactory;

     public function state()
    {
        return $this->belongsTo('App\Models\State');
    }
}
