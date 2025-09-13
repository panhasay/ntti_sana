<?php

namespace App\Models\General;

use App\Models\SystemSetup\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSchedule extends Model
{
    use HasFactory;
    protected $table = 'class_schedule';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

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
    // In the ExamSchedule model
    public function qualification()
    {
        return $this->belongsTo(Qualifications::class);
    }

    public function skill()
    {
        return $this->belongsTo(Skills::class, 'skills_code', 'code');
    }
    // In the ExamSchedule model (App\Models\ExamSchedule)

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_code', 'code');
    }
   

    public function session_year()
    {
        return $this->belongsTo(SessionYear::class, 'session_year_code', 'code');
    }

    public function study_years()
    {
        return $this->belongsTo(StudyYears::class, 'apply_year', 'code');
    }
    // In App\Models\General\ExamSchedule.php

    public function examDateKhmer()
    {
        return $this->hasOne(ExamDateKhmer::class, 'exam_schedule_id', 'id');
    }
}
