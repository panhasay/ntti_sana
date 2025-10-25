<?php

namespace App\Models\General;

use App\Models\Student\Student;
use App\Models\SystemSetup\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClassStudent extends Model
{
    use HasFactory;

    protected $table = 'class_student';
    
    // protected $primaryKey = 'code';
    // protected $foreignKey = 'code'; // Corrected property name

    protected $primaryKey = 'id';
    protected $keyType = 'string'; 
  
    protected $fillable = [
        '*',
    ];

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
     public function student()
    {
        return $this->belongsTo(Student::class, 'student_code', 'code');
    }

    public function teacher()
    {
        return $this->belongsTo(Teachers::class, 'teachers_code', 'code');
    }
    public function subject()
    {
        return $this->belongsTo(Subjects::class, 'subjects_code', 'code');
    }

    public function scopeWhitQueryPermissionTeacher($query)
    {
        $user = Auth::user();

        if ($user->department_code === 'D_IT') {
            return $query->where('department_code', 'D_IT');
        }

        return $query;
    }
}
