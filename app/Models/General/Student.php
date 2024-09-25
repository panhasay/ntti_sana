<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    // protected $table = 'students';
  
    protected $table = 'student';
    // protected $primaryKey = 'code';
    use HasFactory;
    protected $fillable = [
        '*',
    ];

    // protected $fillable = [
    //     'code',
    //     'name',
    //     'name_2',
    //     'gender',
    //     'date_of_birth',
    //     'phone_student',
    //     'class_code',
    //     'skills_code'
    // ];
    function convertDaysToDate($days)
    {
        $referenceDate = strtotime('1900-01-01');
        $targetDate = $referenceDate + ($days * 86400); // 86400 seconds per day
        // dd($targetDate);
        return date('Y-m-d', $targetDate);
    }
}
