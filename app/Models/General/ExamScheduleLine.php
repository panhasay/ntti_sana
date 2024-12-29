<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamScheduleLine extends Model
{
    use HasFactory;
    protected $table = 'exam_schedule_line';
    protected $primaryKey = 'id';  // Ensure primary key is set
    protected $keyType = 'string'; // Ensure key type is set correctly (if it's a string)

    protected $fillable = [
        'exam_schedule_id',
        'date',
        'subjects_code',
        'teacher_code',
        'document_exam',
        'created_at',
        'updated_at'
    ];
    public function section()
    {
        return $this->belongsTo(Sections::class, 'sections_code', 'code');
    }

    public function subject()
    {
        return $this->belongsTo(Subjects::class, 'subjects_code', 'code');
    }

    public function teacher()
    {
        return $this->belongsTo(Teachers::class, 'teacher_code', 'code');
    }

    public function examSchedule()
    {
        return $this->belongsTo(ExamSchedule::class, 'exam_schedule_id', 'id');
    }

    // Hook into the deleting event
    protected static function boot()
    {
        parent::boot();

        // Listen for the deleting event
        static::deleting(function ($record) {
            if (!empty($record->document_exam) && file_exists(public_path('storage/' . $record->document_exam))) {
                unlink(public_path('storage/' . $record->document_exam));
            }
        });
    }
}
