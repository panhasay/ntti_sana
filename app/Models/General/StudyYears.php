<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyYears extends Model
{
    protected $table = 'study_years';
    
    protected $primaryKey = 'code';
    protected $keyType = 'string'; 
}
