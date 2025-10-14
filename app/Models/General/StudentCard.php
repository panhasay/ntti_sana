<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCard extends Model
{
    use HasFactory;

    protected $table = 'student';

    protected $fillable = [
        'name',
        'name_2',
        'gender',
        'date_of_birth',
        'phone_student',
        'student_address',
        'father_name',
        'father_phone',
        'father_occupation',
        'mother_name',
        'mother_phone',
        'mother_occupation',
        'guardian_name',
        'guardian_phone',
        'guardian_occupation',
        'guardian_address'
    ];
}
