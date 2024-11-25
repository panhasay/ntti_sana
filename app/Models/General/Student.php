<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SystemSetup\Department;
use App\Models\General\Sections;
use App\Models\General\SessionYear;
use App\Models\General\Skills;
use App\Models\General\StudyYears;
use App\Models\General\Teachers;

class Student extends Model
{
    // protected $table = 'students';
  
    protected $table = 'student';
    protected $primaryKey = 'id';
    use HasFactory;
    protected $fillable = [
        '*',
    ];
    function convertDaysToDate($days)
    {
        $referenceDate = strtotime('1900-01-01');
        $targetDate = $referenceDate + ($days * 86400); // 86400 seconds per day
        // dd($targetDate);
        return date('Y-m-d', $targetDate);
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_code', 'code');
    }
    public function section()
    {
        return $this->belongsTo(Sections::class, 'sections_code', 'code');
    }

    public function skill()
    {
        return $this->belongsTo(Skills::class, 'skills_code', 'code');
    }

    public function teacher()
    {
        return $this->belongsTo(Teachers::class, 'teachers_code', 'code');
    }
   
    public function study_years()
    {
        return $this->belongsTo(StudyYears::class, 'apply_year', 'code');
    }
    public function session_year()
    {
        return $this->belongsTo(SessionYear::class, 'session_year_code', 'session_year_code');
    }
}
