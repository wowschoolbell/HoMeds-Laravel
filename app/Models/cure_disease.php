<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cure_disease extends Model
{
    use HasFactory;

      protected $fillable = [
        'name'
    ];

      public function state()
    {
        return $this->belongsTo('App\Models\State');
    }

}
