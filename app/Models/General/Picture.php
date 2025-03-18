<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;
    protected $table = 'picture';
    protected $fillable = [
        'code',
        'type',
        'picture_ori',
        'picture_32bit',
        'picture_128bit',
        'created_at',
        'updated_at',
    ];
}
