<?php

namespace App\Http\Controllers\Report;
use App\Http\Controllers\Controller;
use App\Models\General\student_score;
use Illuminate\Http\Request;
use App\Models\General\AssingClasses;
use App\Models\SystemSetup\Department;
use App\Models\General\Subjects;
use App\Models\General\Classes as ClassModel;
use Illuminate\Support\Facades\DB;
use App\Models\General\ClassSchedule;
use App\Models\Student\Student;

class ReportAttendanceController extends Controller
{
    public function index(Request $request)
    {
        // Fetch filter options
        $years = DB::table('session_year')->orderBy('code', 'desc')->get();
        $semesters = DB::table('assing_classes')->select('semester')->distinct()->pluck('semester');
        $departments = Department::orderBy('name_2')->get();
        $subjects = Subjects::orderBy('name')->get();
        $classes = ClassModel::orderBy('name')->get();

        // Get selected filter values
        $selected_year = $request->year;
        $selected_semester = $request->semester;
        $selected_department = $request->department;
        $selected_subject = $request->subject;
        $selected_class = $request->class;

        $results = [];
        $months = [];
        if ($selected_class) {
            // Get all students in the class
            $students = Student::where('class_code', $selected_class)->get();

            // Get all scores for this class (all assign_line_no)
            $scores = \App\Models\General\student_score::with('student')
                ->whereHas('student', function($q) use ($selected_class) {
                    $q->where('class_code', $selected_class);
                })
                ->get();

            // Build list of all months present in the data
            $allMonths = $scores->map(function($score) {
                return date('Y-m', strtotime($score->att_date));
            })->unique()->sort()->values();

            $khmerMonths = [
                '01' => 'មករា',
                '02' => 'កម្ភៈ',
                '03' => 'មីនា',
                '04' => 'មេសា',
                '05' => 'ឧសភា',
                '06' => 'មិថុនា',
                '07' => 'កក្កដា',
                '08' => 'សីហា',
                '09' => 'កញ្ញា',
                '10' => 'តុលា',
                '11' => 'វិច្ឆិកា',
                '12' => 'ធ្នូ',
            ];
            foreach ($allMonths as $ym) {
                [$year, $month] = explode('-', $ym);
                $months[$ym] = [
                    'name' => $khmerMonths[$month] ?? $month,
                    'start' => '01',
                    'end' => date('t', strtotime("$year-$month-01")),
                    'year' => $year,
                    'month' => $month,
                ];
            }

            // Group scores by student and month
            $scoresByStudentMonth = [];
            foreach ($scores as $score) {
                $studentCode = $score->student_code;
                $ym = date('Y-m', strtotime($score->att_date));
                if (!isset($scoresByStudentMonth[$studentCode][$ym])) {
                    $scoresByStudentMonth[$studentCode][$ym] = ['permission' => 0, 'absent' => 0];
                }
                if ($score->att_score == 0.5) {
                    $scoresByStudentMonth[$studentCode][$ym]['permission']++;
                } elseif ($score->att_score == 0) {
                    $scoresByStudentMonth[$studentCode][$ym]['absent']++;
                }
            }

            // Build results: one row per student
            foreach ($students as $student) {
                $studentCode = $student->code;
                $monthly = [];
                foreach (array_keys($months) as $ym) {
                    $monthly[$ym] = [
                        'permission' => $scoresByStudentMonth[$studentCode][$ym]['permission'] ?? 0,
                        'absent' => $scoresByStudentMonth[$studentCode][$ym]['absent'] ?? 0,
                    ];
                }
                $total_permission = array_sum(array_column($monthly, 'permission'));
                $total_absent = array_sum(array_column($monthly, 'absent'));
                $results[] = [
                    'student_code' => $studentCode,
                    'student_name' => $student->name_2 ?? '',
                    'monthly' => $monthly,
                    'total_permission' => $total_permission,
                    'total_absent' => $total_absent,
                ];
            }
        }

        // Prepare filter values
        $filters = [
            'year' => $selected_year,
            'semester' => $selected_semester,
            'department' => $selected_department,
            'subject' => $selected_subject,
            'class' => $selected_class,
        ];

        return view('reports.report_attendance_student', [
            'results' => $results,
            'months' => $months,
            'attendance_types' => [
                ['value' => 2, 'label' => 'វត្តមាន'],    // Present
                ['value' => 1, 'label' => 'យឺត'],        // Late
                ['value' => 0.5, 'label' => 'ច្បាប់'],    // Permission/Leave
                ['value' => 0, 'label' => 'អវត្តមាន'],   // Absent
            ],
            'filters' => $filters,
            'years' => $years,
            'semesters' => $semesters,
            'departments' => $departments,
            'subjects' => $subjects,
            'classes' => $classes,
        ]);
    }
    
    public function getDepartmentOptions($code)
    {
        $subjects = \App\Models\General\Subjects::where('department_code', $code)->orderBy('name')->get(['code', 'name']);
        $classes = \App\Models\General\Classes::where('department_code', $code)->orderBy('name')->get(['code', 'name']);
        return response()->json([
            'subjects' => $subjects,
            'classes' => $classes,
        ]);
    }
    
}
