<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'role';

    protected $primaryKey = 'code';
    protected $keyType = 'string';
  
    protected $fillable = [
        '*',
    ];

    
}
