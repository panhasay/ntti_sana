<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AttendanceSemesterExport implements FromView
{
    protected $records;
    protected $uniqueStudents;
    protected $attendanceMonths;
    protected $classCode;
    protected $semester;
    protected $years;

    public function __construct($records, $uniqueStudents, $attendanceMonths, $classCode, $semester, $years)
    {
        $this->records = $records;
        $this->uniqueStudents = $uniqueStudents;
        $this->attendanceMonths = $attendanceMonths;
        $this->classCode = $classCode;
        $this->semester = $semester;
        $this->years = $years;
    }

    public function view(): View
    {
        return view('general.attendance_list_excel', [
            'records' => $this->records,
            'uniqueStudents' => $this->uniqueStudents,
            'attendanceMonths' => $this->attendanceMonths,
            'classCode' => $this->classCode,
            'semester' => $this->semester,
            'years' => $this->years,
        ]);
    }
}

