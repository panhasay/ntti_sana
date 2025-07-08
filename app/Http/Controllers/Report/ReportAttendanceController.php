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

        // Only fetch attendance for selected class
        $results = [];
        if ($selected_class) {
            $scores = student_score::with('student')
                ->whereHas('student', function($q) use ($selected_class) {
                    $q->where('class_code', $selected_class);
                })
                ->orderBy('assign_line_no')
                ->orderBy('student_code')
                ->get()
                ->groupBy('assign_line_no');

            foreach ($scores as $assignLineNo => $groupedScores) {
                $students = $groupedScores->groupBy('student_code');
                $studentList = [];
                foreach ($students as $studentCode => $studentScores) {
                    $scoreCounts = $studentScores->pluck('att_score')->countBy();
                    // Monthly attendance counts
                    $monthly = [
                        '08' => 0, // August
                        '09' => 0, // September
                        '10' => 0, // October
                        '11' => 0, // November
                        '12' => 0, // December
                    ];
                    foreach ($studentScores as $score) {
                        $month = date('m', strtotime($score->att_date));
                        if (isset($monthly[$month])) {
                            $monthly[$month]++;
                        }
                    }
                    $studentList[] = [
                        'student_code' => $studentCode,
                        'student_name' => $studentScores->first()->student->name_2 ?? '',
                        'scores' => $studentScores->pluck('att_score'),
                        'score_count' => $scoreCounts,
                        'monthly' => $monthly,
                    ];
                }
                $classInfo = AssingClasses::where('assing_no', $assignLineNo)->first();
                $results[] = [
                    'assign_line_no' => $assignLineNo,
                    'class_info' => $classInfo,
                    'total_students' => count($students),
                    'students' => $studentList,
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
    
    // public function index(Request $request)
    // {
    //     // Logic to handle the request and return attendance report
    //     // This could involve fetching data from a model, processing it, and returning a view or JSON response

    //     return view('reports.report_attendance_student'); // Corrected view path
    // }
    
}
