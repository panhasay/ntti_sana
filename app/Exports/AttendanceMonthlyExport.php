<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AttendanceMonthlyExport implements FromView
{
    protected $records;
    protected $classCode;
    protected $semester;
    protected $years;
    protected $attendanceMonths;
    protected $students;
    protected $qualification;
    protected $skill_name;
    protected $section_name;
    protected $session_year_code;

    public function __construct(
        $records, 
        $classCode, 
        $semester, 
        $years, 
        $attendanceMonths, 
        $students,
        $qualification,
        $section_name,
        $skill_name,
        $session_year_code,
    )
    {
        $this->records = $records;
        $this->classCode = $classCode;
        $this->semester = $semester;
        $this->years = $years;
        $this->attendanceMonths = $attendanceMonths;
        $this->students = $students;
        $this->section_name = $section_name;
        $this->skill_name = $skill_name;
        $this->qualification = $qualification;
        $this->session_year_code = $session_year_code;
    }

    public function view(): View
    {
        return view('general.attendance_list_monthly_excel', [
            'records' => $this->records,
            'classCode' => $this->classCode,
            'semester' => $this->semester,
            'years' => $this->years,
            'attendanceMonths' => $this->attendanceMonths,
            'students' => $this->students,
            'section_name' => $this->section_name,
            'skill_name' => $this->skill_name,
            'qualification' => $this->qualification,
            'session_year_code'=>$this->session_year_code
        ]);
    }
}
