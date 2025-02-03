<?php  

namespace App\Models\Student;  

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  
use App\Models\General\Qualifications;  
use App\Models\SystemSetup\Department;  
use App\Models\General\Sections;  
use App\Models\General\SessionYear;  
use App\Models\General\Skills;  
use App\Models\General\StudyYears;
use App\Models\General\Subjects;
use App\Models\General\Teachers;  

class Student extends Model {  
    use HasFactory;  

    protected $table = 'student';  
    protected $primaryKey = 'id';  

    protected $fillable = [
        // List the fillable attributes explicitly
        'name', 'department_code', 'sections_code', 'skills_code', 
        'teachers_code', 'apply_year', 'session_year_code', 'qualification',
    ];  

    /**
     * Convert number of days to a date starting from 1900-01-01
     */
    public function convertDaysToDate($days) {  
        $referenceDate = strtotime('1900-01-01');  
        $targetDate = $referenceDate + ($days * 86400); // 86400 seconds per day  
        return date('Y-m-d', $targetDate);  
    }  

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
}
