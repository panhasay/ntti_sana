<?php

namespace App\Models\General;

use App\Models\Models\General\DateKhmer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class ExamScheduleLine extends Model
{
    use HasFactory;
    protected $table = 'exam_schedule_line';
    protected $primaryKey = 'id';  // Ensure primary key is set
    protected $keyType = 'string'; // Ensure key type is set correctly (if it's a string)

    protected $fillable = [
        'exam_schedule_id',
        'date',
        'date_name_code',
        'start_time',
        'end_time',
        'room',
        'subjects_code',
        'teacher_code',
        'co_teacher_code',
        'co_teacher_code1',
        'document_exam',
        'is_second_schedule',
        'start_time_second',
        'end_time_second',
        'room_second',
        'subjects_code_second',
        'teacher_code_second',
        'co_teacher_code_second',
        'co_teacher_code1_second',
        'document_exam_second'
    ];

    public function section()
    {
        return $this->belongsTo(Sections::class, 'sections_code', 'code');
    }

    public function subject()
    {
        return $this->belongsTo(Subjects::class, 'subjects_code', 'code');
    }

    public function subjectSecond()
    {
        return $this->belongsTo(Subjects::class, 'subjects_code_second', 'code');
    }

    public function teacher()
    {
        return $this->belongsTo(Teachers::class, 'teacher_code', 'code');
    }

    public function teacherSecond()
    {
        return $this->belongsTo(Teachers::class, 'teacher_code_second', 'code');
    }

    public function examSchedule()
    {
        return $this->belongsTo(ExamSchedule::class, 'exam_schedule_id', 'id');
    }

    public function coTeacher()
    {
        return $this->belongsTo(Teachers::class, 'co_teacher_code', 'code');
    }

    public function coTeacherSecond()
    {
        return $this->belongsTo(Teachers::class, 'co_teacher_code_second', 'code');
    }

    public function coTeacher1()
    {
        return $this->belongsTo(Teachers::class, 'co_teacher_code1', 'code');
    }

    public function coTeacher1Second()
    {
        return $this->belongsTo(Teachers::class, 'co_teacher_code1_second', 'code');
    }

    public function getDayOfWeekAttribute()
    {
        return Carbon::parse($this->date)->dayOfWeek;
    }

    public function study_years()
    {
        return $this->belongsTo(StudyYears::class, 'apply_year', 'code');
    }

    // Hook into the deleting event
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($record) {
            // Delete first schedule document
            if (!empty($record->document_exam) && file_exists(public_path('storage/' . $record->document_exam))) {
                unlink(public_path('storage/' . $record->document_exam));
            }

            // Delete second schedule document
            if (!empty($record->document_exam_second) && file_exists(public_path('storage/' . $record->document_exam_second))) {
                unlink(public_path('storage/' . $record->document_exam_second));
            }
        });
    }
}
