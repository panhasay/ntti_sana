<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertMainModule extends Model
{
    use HasFactory;

    protected $table = 'cert_main_modules';

    public const UPDATED_AT = null;

    protected $fillable = [
        'name_kh',
        'name_eng',
        'icon',
        'url',
        'active',
    ];

    public $timestamps = false;

    protected $dates = ['created_at'];
}
