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

        // Get semester start date and session year code from class_schedule
        $semester_start_date = null;
        $class_schedule_year_code = null;
        if ($selected_class && $selected_semester) {
            $schedule = ClassSchedule::where('class_code', $selected_class)
                ->where('semester', $selected_semester)
                ->orderBy('start_date', 'asc')
                ->first();
            if ($schedule) {
                $semester_start_date = $schedule->start_date;
                $class_schedule_year_code = $schedule->session_year_code ?? null;
            }
        }

        // Get start date for the next semester (for the same class)
        $next_semester_start_date = null;
        if ($selected_class && $selected_semester) {
            $next_semester = $selected_semester + 1;
            $next_schedule = ClassSchedule::where('class_code', $selected_class)
                ->where('semester', $next_semester)
                ->orderBy('start_date', 'asc')
                ->first();
            if ($next_schedule) {
                $next_semester_start_date = $next_schedule->start_date;
            }
        }

        // Determine the end date for the report
        if ($next_semester_start_date) {
            $report_end_date = \Carbon\Carbon::parse($next_semester_start_date)->subDay(); // The day before next semester starts
        } else {
            $report_end_date = now(); // Or use a fixed end date if you prefer
        }

        // Build all months from semester start to report end
        $months = [];
        if ($semester_start_date) {
            $start = \Carbon\Carbon::parse($semester_start_date)->startOfMonth();
            $end = \Carbon\Carbon::parse($report_end_date)->endOfMonth();
            $current = $start->copy();
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
            while ($current <= $end) {
                $ym = $current->format('Y-m');
                $months[$ym] = [
                    'name' => $khmerMonths[$current->format('m')] ?? $current->format('m'),
                    'start' => '01',
                    'end' => $current->daysInMonth,
                    'year' => $current->format('Y'),
                    'month' => $current->format('m'),
                ];
                $current->addMonth();
            }
        }

        $results = [];
        if ($selected_class) {
            // Get all students in the class
            $students = Student::where('class_code', $selected_class)->get();

            // Get all scores for this class, filtered by semester start date
            $scores = \App\Models\General\student_score::with('student')
                ->whereHas('student', function($q) use ($selected_class) {
                    $q->where('class_code', $selected_class);
                })
                ->when($semester_start_date, function($query) use ($semester_start_date) {
                    $query->where('att_date', '>=', $semester_start_date);
                })
                // Optionally filter by year code if class_schedule_year_code is set and matches selected_year
                ->when($selected_year && $class_schedule_year_code, function($query) use ($selected_year, $class_schedule_year_code) {
                    if ($class_schedule_year_code != $selected_year) {
                        $query->whereRaw('0 = 1');
                    }
                })
                ->get();

            // Trim $months to only include up to the last month with attendance data
            $lastMonthWithData = null;
            if (count($scores) > 0) {
                $lastMonthWithData = $scores->max(function($score) {
                    return date('Y-m', strtotime($score->att_date));
                });
            }
            if ($lastMonthWithData) {
                $months = array_filter(
                    $months,
                    function($key) use ($lastMonthWithData) {
                        return $key <= $lastMonthWithData;
                    },
                    ARRAY_FILTER_USE_KEY
                );
            } else {
                $months = [];
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
