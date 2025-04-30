<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student\Student;

class student_score extends Model
{
    use HasFactory;
    protected $table = 'student_score';
    protected $primaryKey = 'id';
    protected $fillable = ['assign_line_no', 'student_code', 'att_date', 'att_score'];


    public function student()
    {
        return $this->belongsTo(Student::class, 'student_code', 'code');
    }
    public function subject()
    {
        return $this->belongsTo(Subjects::class, 'subjects_code', 'code');
    }
}
