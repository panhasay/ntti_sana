<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model
{
    use HasFactory;
    protected $table = 'class_schedule';
    // protected $primaryKey = 'code';
    // protected $foreignKey = 'code'; // Corrected property name

    protected $primaryKey = 'id';
    protected $keyType = 'string'; // Specify the key type if necessary
  
    protected $fillable = [
        '*',
    ];
    public function section()
    {
        return $this->belongsTo(Sections::class, 'sections_code', 'code');
    }
    public function subject()
    {
        return $this->belongsTo(Subjects::class, 'subjects_code', 'code');
    }
}
