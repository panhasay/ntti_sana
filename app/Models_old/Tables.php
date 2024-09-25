<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Tables extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'table';
    protected $primaryKey = 'id';
    public $incrementing = true;
    use HasFactory;


}
