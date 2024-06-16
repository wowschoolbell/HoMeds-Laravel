<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class items extends Model
{
    use HasFactory; 

     public static function getByCategoryIds(array $categoryIds)
    {
        return self::whereHas('disease', function ($query) use ($categoryIds) {
            $query->whereIn('categories.id', $categoryIds);
        })->get();
    }

    
     public function category()
    {
          return $this->belongsTo(category::class, 'category', 'id');
    }

    public function disease()
    {
        return $this->belongsTo(cure_disease::class, 'cure_disease', 'id');
       
    }
}
