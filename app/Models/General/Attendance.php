<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = 'assing_classes';
    // protected $primaryKey = 'code';
    // protected $foreignKey = 'code'; // Corrected property name

    protected $primaryKey = 'id';
    protected $keyType = 'string'; // Specify the key type if necessary
    use HasFactory;
}
