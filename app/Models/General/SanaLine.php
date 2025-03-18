<?php

namespace App\Models\General;

use App\Models\Student\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanaLine extends Model
{
    use HasFactory;
    protected $table = 'sana_line';
    // protected $primaryKey = 'code';
    // protected $foreignKey = 'code'; 

    protected $primaryKey = 'id';
    protected $keyType = 'string'; 

    protected $fillable = [
        '*',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_code', 'code');
    }
    public function subject()
    {
        return $this->belongsTo(Subjects::class, 'subjects_code', 'code');
    }
    public function teacher()
    {
        return $this->belongsTo(Teachers::class, 'teacher_leader_code', 'code');
    }
    public function teacher_consult()
    {
        return $this->belongsTo(Teachers::class, 'teacher_consult_code', 'code');
    }
}
