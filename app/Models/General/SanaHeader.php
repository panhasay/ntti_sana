<?php

namespace App\Models\General;

use App\Models\Student\Student;
use App\Models\SystemSetup\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanaHeader extends Model
{
    use HasFactory;
    protected $table = 'sana_header';
    // protected $primaryKey = 'code';
    // protected $foreignKey = 'code'; // Corrected property name

    protected $primaryKey = 'no';
    protected $keyType = 'string'; // Specify the key type if necessary
  
    protected $fillable = [
        '*',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_code', 'code');
    }
    
    
    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_code', 'code');
    }
    
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_code', 'code');
    }
    
    public function skill()
    {
        return $this->belongsTo(Skills::class, 'skills_code', 'code');
    }
    
    public function section() 
    {
        return $this->belongsTo(Sections::class, 'sections_code', 'code');
    }
    
    public function subject()
    {
        return $this->belongsTo(Subjects::class, 'subjects_code', 'code');
    }
}
