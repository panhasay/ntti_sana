<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
    use HasFactory;
    protected $table = 'skills';
    protected $primaryKey = 'code';
    protected $keyType = 'string'; // Specify the key type if necessary
  
    protected $fillable = [
        '*',
    ];
}
