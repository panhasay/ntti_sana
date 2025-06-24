<?php

namespace App\Models\General;

use App\Models\SystemSetup\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AssingClasses extends Model
{
    use HasFactory;

    protected $table = 'assing_classes';

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

    public function teacher()
    {
        return $this->belongsTo(Teachers::class, 'teachers_code', 'code');
    }
    public function subject()
    {
        return $this->belongsTo(Subjects::class, 'subjects_code', 'code');
    }

    public function level()
    {
        return $this->hasOne(Qualifications::class, 'code', 'qualification');
    }

    public function class()
    {
        return $this->hasOne(Classes::class, 'code', 'class_code');
    }

    public function sessionYear()
    {
        return $this->hasOne(SessionYear::class, 'code', 'session_year_code');
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
