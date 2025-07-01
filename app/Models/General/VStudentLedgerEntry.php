<?php

// app/Models/VStudentLedgerEntry.php

namespace App\Models\General;

use App\Models\SystemSetup\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class VStudentLedgerEntry extends Model
{
    protected $table = 'v_student_ledger_entry';
    public $timestamps = false;

    // use HasQueryPermission; // only if your project has this
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
       return $this->belongsTo(SessionYear::class, 'session_year_code', 'code');
   }
   public function student()
   {
       return $this->belongsTo(StudentRegistration::class, 'student_code', 'code');
   }
    public function scopeWithQueryPermission($query)
    {
        $user = Auth::user();
        if ($user->department_code) {
           return $query->where('department_code', $user->department_code);
        }else {
            return $query;
        }
        
    }
}
