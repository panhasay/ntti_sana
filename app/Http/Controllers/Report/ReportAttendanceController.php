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
            // Fetch the class schedule to get the start_date
            $classSchedule = ClassSchedule::where('class_code', $selected_class)
                ->when($selected_semester, function($q) use ($selected_semester) {
                    $q->where('semester', $selected_semester);
                })
                ->when($selected_year, function($q) use ($selected_year) {
                    $q->where('years', $selected_year);
                })
                ->first();

            // Default to current month if not found
            $startDate = $classSchedule ? $classSchedule->start_date : date('Y-m-01');
            $start = \Carbon\Carbon::parse($startDate);
            // Khmer month names
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
            $months = [];
            for ($i = 0; $i < 5; $i++) {
                $monthDate = $start->copy()->addMonths($i);
                $monthKey = $monthDate->format('m');
                $monthYear = $monthDate->format('Y');
                $monthName = $khmerMonths[$monthKey] ?? $monthDate->format('F');
                $startOfMonth = $monthDate->copy()->startOfMonth()->format('d');
                $endOfMonth = $monthDate->copy()->endOfMonth()->format('d');
                $months[$monthKey] = [
                    'name' => $monthName,
                    'start' => $startOfMonth,
                    'end' => $endOfMonth,
                    'year' => $monthYear,
                ];
            }

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
                    // Dynamic monthly attendance counts
                    $monthly = [];
                    foreach (array_keys($months) as $month) {
                        $monthly[$month] = 0;
                    }
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
                    'months' => $months,
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
