<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateSubModule extends Model
{
    use HasFactory;

    protected $table = 'cert_sub_module';
    protected $primaryKey = 'id';
    protected $fillable  = [
        'name_kh',
        'name_eng',
        'icon',
        'url',
        'controller',
    ];
}
