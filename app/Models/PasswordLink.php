<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordLink extends Model
{
    use HasFactory;
    
    protected $table = 'password_link';
    
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'email_id', 'hash'
    ];
}
