<?php

namespace App\Models\General;

use App\Models\SystemSetup\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Classes extends Model
{
    use HasFactory;
    protected $table = 'classes';
    // protected $primaryKey = 'code';
    // protected $foreignKey = 'code'; // Corrected property name

    protected $primaryKey = 'code';
    protected $keyType = 'string'; // Specify the key type if necessary

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
    public function qualification()
    {
        return $this->belongsTo(Qualifications::class, 'level', 'code');
    }
   public function scopeWithQueryPermissionTeacher($query)
    {
        $user = Auth::user();

        if ($user->department_code === 'D_IT') {
            return $query->where('classes.department_code', 'D_IT');
        }

        return $query;
    }
}
