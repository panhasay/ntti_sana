<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersModels extends Model
{
    protected $table = 'users' ;
    use HasFactory;

    
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
