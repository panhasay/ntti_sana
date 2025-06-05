<?php

namespace App\Models\Certificates;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertSubModule extends Model
{
    use HasFactory;

    protected $table = 'cert_sub_module';

    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;

    public const CREATED_AT = 'create_at';
    public const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'code',
        'name_kh',
        'name_eng',
        'icon',
        'route',
        'controller',
        'active',
    ];
}
