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
use Illuminate\Support\Facades\Auth;

class ReportAttendanceController extends Controller
{
    public function index(Request $request)
    {
        // Get current user and their department
        $user = Auth::user();
        $userDepartmentCode = $user->department_code ?? null;
        
        // Fetch filter options
        $years = DB::table('session_year')->orderBy('code', 'desc')->get();
        $semesters = DB::table('assing_classes')->select('semester')->distinct()->pluck('semester');
        
        // Set default department for all users based on their department_code
        $selected_department = $request->department ?? $userDepartmentCode;
        
        // Filter departments based on user role and department
        if ($user->role == 'admin') {
            $departments = Department::orderBy('name_2')->get();
        } else {
            // For non-admin users, only show their department
            $departments = Department::where('code', $userDepartmentCode)->orderBy('name_2')->get();
        }
        
        // Filter classes based on user's department
        if ($userDepartmentCode) {
            // For all users (including admin), filter classes by their department by default
            $classes = ClassModel::where('department_code', $userDepartmentCode)->orderBy('name')->get();
        } else {
            $classes = ClassModel::orderBy('name')->get();
        }

        // Get selected filter values with defaults based on user's department
        $selected_year = $request->year;
        $selected_semester = $request->semester;
        
        // Initialize validation errors array
        $validationErrors = [];
        
        // Check if form was submitted (has any of the required fields)
        $formSubmitted = $request->has('year') || $request->has('semester') || $request->has('class');
        
        // Validate required fields only if form was submitted
        if ($formSubmitted) {
            if (empty($selected_year)) {
                $validationErrors['year'] = 'សូមជ្រើសរើសឆ្នាំសិក្សា';
            }
            if (empty($selected_semester)) {
                $validationErrors['semester'] = 'សូមជ្រើសរើសឆមាស';
            }
            if (empty($request->class)) {
                $validationErrors['class'] = 'សូមជ្រើសរើសថ្នាក់';
            }
        }
        
        // Set default class based on user's department for all users
        $defaultClass = null;
        if ($userDepartmentCode && !$request->class) {
            $defaultClass = ClassModel::where('department_code', $userDepartmentCode)
                ->orderBy('name')
                ->first();
        }
        $selected_class = $request->class ?? ($defaultClass ? $defaultClass->code : '');
        
        // Set default semester if class is selected but no semester
        if ($selected_class && !$selected_semester) {
            $defaultSemester = DB::table('assing_classes')
                ->where('class_code', $selected_class)
                ->select('semester')
                ->distinct()
                ->orderBy('semester')
                ->first();
            $selected_semester = $defaultSemester ? $defaultSemester->semester : null;
        }

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
            } else {
                // If no schedule found, add to validation errors
                $validationErrors['class'] = 'រកមិនឃើញកាលវិភាគសម្រាប់ថ្នាក់និងឆមាសដែលបានជ្រើសរើស';
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
        $results = [];

        if ($semester_start_date) {
            $current = \Carbon\Carbon::parse($semester_start_date);
            $end = \Carbon\Carbon::parse($report_end_date);
            $months = [];
            $firstMonth = true;
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
            $khmerNumbers = [
                '0' => '០',
                '1' => '១',
                '2' => '២',
                '3' => '៣',
                '4' => '៤',
                '5' => '៥',
                '6' => '៦',
                '7' => '៧',
                '8' => '៨',
                '9' => '៩',
            ];
            while ($current <= $end) {
                $yearMonth = $current->format('Y-m');
                $monthNumber = $current->format('m');
                $year = $current->format('Y');
                $khmerMonth = $khmerMonths[$monthNumber] ?? $monthNumber;
                if ($firstMonth) {
                    $startDay = strtr($current->format('d'), $khmerNumbers);
                    $firstMonthStart = $current->copy();
                    $firstMonthEnd = $current->copy()->endOfMonth();
                    $endDay = strtr($firstMonthEnd->format('d'), $khmerNumbers);
                    $months[$yearMonth] = [
                        'name' => 'ខែ ' . $khmerMonth,
                        'start' => 'ថ្ងៃទី ' . $startDay,
                        'end' => 'ដល់ថ្ងៃទី ' . $endDay,
                        'from' => $firstMonthStart->toDateString(),
                        'to' => $firstMonthEnd->toDateString(),
                    ];
                    $current = $firstMonthEnd->addDay();
                    $firstMonth = false;
                } else {
                    $monthStart = $current->copy()->startOfMonth();
                    $monthEnd = $current->copy()->endOfMonth();
                    $startDay = strtr($monthStart->format('d'), $khmerNumbers);
                    $endDay = strtr($monthEnd->format('d'), $khmerNumbers);
                    $months[$yearMonth] = [
                        'name' => 'ខែ ' . $khmerMonth,
                        'start' => 'ថ្ងៃទី ' . $startDay,
                        'end' => 'ដល់ថ្ងៃទី ' . $endDay,
                        'from' => $monthStart->toDateString(),
                        'to' => $monthEnd->toDateString(),
                    ];
                    $current = $monthEnd->addDay();
                }
            }
        }

        if ($selected_class) {
            // Check if class exists
            $class = ClassModel::where('code', $selected_class)->first();
            if (!$class) {
                $validationErrors['class'] = 'ថ្នាក់ដែលបានជ្រើសរើសមិនមាន';
            } else {
                // Get all students in the class
                $students = Student::where('class_code', $selected_class)->get();
                
                // Check if class has students
                if ($students->isEmpty()) {
                    $validationErrors['class'] = 'ថ្នាក់នេះមិនមានសិស្ស';
                }
            }

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

            // Group scores by student and month (handle first month as partial)
            $scoresByStudentMonth = [];
            foreach ($scores as $score) {
                $studentCode = $score->student_code;
                $scoreDate = \Carbon\Carbon::parse($score->att_date);
                // Find the correct month bucket for this score
                foreach ($months as $ym => $monthInfo) {
                    $from = \Carbon\Carbon::parse($monthInfo['from']);
                    $to = \Carbon\Carbon::parse($monthInfo['to']);
                    if ($scoreDate->between($from, $to)) {
                        if (!isset($scoresByStudentMonth[$studentCode][$ym])) {
                            $scoresByStudentMonth[$studentCode][$ym] = ['permission' => 0, 'absent' => 0];
                        }
                        if ($score->att_score == 0.5) {
                            $scoresByStudentMonth[$studentCode][$ym]['permission']++;
                        } elseif ($score->att_score == 0) {
                            $scoresByStudentMonth[$studentCode][$ym]['absent']++;
                        }
                        break;
                    }
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

        // Get skill name, year level, qualification, session year, and section for display
        $skillName = '';
        $yearLevel = '';
        $qualification = '';
        $sessionYear = '';
        $sectionName = '';
        if ($selected_class) {
            $class = ClassModel::where('code', $selected_class)->first();
            if ($class) {
                // Get skill name
                if ($class->skills_code) {
                    $skill = DB::table('skills')->where('code', $class->skills_code)->first();
                    $skillName = $skill ? $skill->name_2 : $class->skills_code;
                }
                
                // Get year level, qualification, session year, and section from class_schedule
                if ($selected_semester) {
                    $schedule = ClassSchedule::where('class_code', $selected_class)
                        ->where('semester', $selected_semester)
                        ->first();
                    if ($schedule) {
                        if ($schedule->years) {
                            $yearLevel = $schedule->years;
                        }
                        if ($schedule->qualification) {
                            $qualification = $schedule->qualification;
                        }
                        if ($schedule->session_year_code) {
                            $sessionYear = $schedule->session_year_code;
                        }
                        if ($schedule->sections_code) {
                            $section = DB::table('sections')->where('code', $schedule->sections_code)->first();
                            $sectionName = $section ? $section->name_2 : $schedule->sections_code;
                        }
                    }
                }
            }
        }
        
        // Convert numbers to Khmer numerals
        $khmerNumbers = [
            '0' => '០',
            '1' => '១',
            '2' => '២',
            '3' => '៣',
            '4' => '៤',
            '5' => '៥',
            '6' => '៦',
            '7' => '៧',
            '8' => '៨',
            '9' => '៩',
        ];
        
        $khmerYear = $selected_year ? strtr($selected_year, $khmerNumbers) : '';
        $khmerSemester = $selected_semester ? strtr($selected_semester, $khmerNumbers) : '';
        $khmerYearLevel = $yearLevel ? strtr($yearLevel, $khmerNumbers) : '';
        
        // Prepare filter values
        $filters = [
            'year' => $selected_year,
            'semester' => $selected_semester,
            'department' => $selected_department,
            'skill_name' => $skillName,
            'class' => $selected_class,
            'qualification' => $qualification,
            'session_year' => $sessionYear,
            'section_name' => $sectionName,
            'khmer_year' => $khmerYear,
            'khmer_semester' => $khmerSemester,
            'khmer_year_level' => $khmerYearLevel,
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
            'classes' => $classes,
            'validationErrors' => $validationErrors,
        ]);
    }
    
    public function getDepartmentOptions($code)
    {
        $classes = \App\Models\General\Classes::where('department_code', $code)->orderBy('name')->get(['code', 'name']);
        return response()->json([
            'classes' => $classes,
        ]);
    }
    
}
