<?php

namespace App\Models\SystemSetup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableField extends Model
{
    protected $table = 'table_field';
    protected $primaryKey = 'id';
    public $incrementing = true;

    use HasFactory;
}
