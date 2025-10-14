<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\General\ClassSchedule;
use App\Models\General\AssingClasses;
use App\Models\General\student_score;
use App\Models\General\Sections;
use App\Models\Student\Student;
use App\Models\SystemSetup\Department;
use Carbon\Carbon;
use App\Exports\AttendanceMonthlyExport;
use App\Exports\AttendanceSemesterExport;
use App\Exports\ExamCreditScoringExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use App\Service\service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\General\AssingClassesStudentLine;

class ExamCreditController extends Controller
{
    public $services;
    public $page_id;
    public $page;
    public $prefix;
    public $table_id;
    public $arrayJoin = [];

    function __construct()
    {
        $this->services = new service();
        $this->page_id = "10001";
        $this->page = "exam_credit";
        $this->prefix = "exam_credit";
        $this->arrayJoin = ['10001', '10007', '10008'];
        $this->table_id = "10005";
    }
    
    public function index(Request $request)
    {
        if(!Auth::check()){
            return redirect("login")->withSuccess('Opps! You do not have access');
        }  

        $page = "exam-credit";
        $records = AssingClasses::select('class_code', 'semester', 'years', 'skills_code', 'qualification', 'sections_code','session_year_code')->groupBy('class_code', 'semester', 'years', 'skills_code', 'qualification', 'sections_code','session_year_code')->paginate(10);

        // dd($records);
         
        $data = $this->services->GetDateIndexOption(now()); 

        return view('general.exam_credit', array_merge($data, compact('records', 'page')));
    }

    public function GetStudentDetail(Request $request)
    {
        $code = $request->code;
        try {
            $records = AssingClassesStudentLine::select(
                    'student.code as student_code',
                    'student.name as student_name',
                    'student.gender',
                    'student.name_2',
                    DB::raw("COUNT(CASE WHEN sc.att_score = 0 THEN 1 END) as absent_count"),
                    DB::raw("MAX(sc.att_date) as last_attendance")
                )
                ->join('student', function ($join) {
                    $join->on(DB::raw('student.code COLLATE utf8mb4_unicode_ci'), '=', 'assing_classes_student_line.student_code');
                })
                ->leftJoin('student_score as sc', function ($join) {
                    $join->on('sc.student_code', '=', 'assing_classes_student_line.student_code')
                        ->on('sc.assign_line_no', '=', 'assing_classes_student_line.assing_line_no');
                })
                ->where('assing_classes_student_line.assing_line_no', $code)
                ->groupBy('student.code', 'student.name', 'student.gender', 'student.name_2')
                ->orderByRaw('student.name_2 COLLATE utf8mb4_unicode_ci ASC')
                ->get();

            return response()->json([
                'status' => 'success',
                'html' => view('general.exam_credit_student_detail', compact('records'))->render()
            ]);
        } catch (\Exception $ex) {
            return response()->json(['status' => 'error', 'msg' => $ex->getMessage()]);
        }
    }
    public function printAttedanceList(Request $request)
    {
        $classCode = $request->input('class_code');
        $semester = $request->input('semester');
        $years = $request->input('years');

        try {
            $records = DB::table('student as s')
                ->selectRaw("
                    s.code as student_code,
                    s.name as student_name_en,
                    s.name_2 as student_name_kh,
                    s.gender,
                    ac.qualification,
                    s.class_code,
                    ac.semester,
                    ac.session_year_code,
                    sk.name_2 as skill_name,
                    se.name_2 as section_name,
                    ac.years,
                    GROUP_CONCAT(DISTINCT CONCAT(YEAR(sc.att_date), '-', LPAD(MONTH(sc.att_date), 2, '0')) ORDER BY YEAR(sc.att_date), MONTH(sc.att_date)) AS attended_months,
                    COUNT(CASE WHEN sc.att_score = 0 THEN 1 END) AS total_absent,
                    COUNT(CASE WHEN sc.att_score = 0.5 THEN 1 END) AS total_permission,
                    YEAR(sc.att_date) AS att_year,
                    MONTH(sc.att_date) AS att_month,
                    MIN(DAY(sc.att_date)) AS start_day,
                    MAX(DAY(sc.att_date)) AS end_day
                ")
                ->join('assing_classes as ac', 's.class_code', '=', 'ac.class_code')
                ->leftJoin('skills as sk', 'sk.code', 'ac.skills_code')
                ->leftJoin('sections as se', 'se.code', 'ac.sections_code')
                ->leftJoin('student_score as sc', function ($join) {
                    $join->on('sc.student_code', '=', 's.code')
                        ->on('sc.assign_line_no', '=', 'ac.assing_no');
                })
                ->when($classCode, fn($query) => $query->where('s.class_code', $classCode))
                ->when($semester, fn($query) => $query->where('ac.semester', $semester))
                ->when($years, fn($query) => $query->where('ac.years', $years))
                ->groupBy(
                    's.code',
                    's.name',
                    's.name_2',
                    's.gender',
                    'ac.qualification',
                    's.class_code',
                    'ac.semester',
                    'ac.years',
                    'sk.name_2',
                    'se.name_2',
                    'att_year',
                    'att_month',
                    'ac.session_year_code',
                )
                ->orderBy('s.code')
                ->orderBy('att_year')
                ->orderBy('att_month')
                ->get();

            $attendanceMonths = $records
            ->filter(fn($item) => !is_null($item->att_year) && !is_null($item->att_month)) // REMOVE records with no attendance
            ->groupBy(function ($item) {
                return $item->att_year . '-' . str_pad($item->att_month, 2, '0', STR_PAD_LEFT);
            })
            ->map(function ($items) {
                return (object) [
                    'att_year' => $items->first()->att_year,
                    'att_month' => $items->first()->att_month,
                    'start_day' => $items->min('start_day'),
                    'end_day' => $items->max('end_day'),
                ];
            })
            ->values();

            $uniqueStudents = $records
                ->groupBy('student_name_kh')
                ->map(fn($items) => $items->first())
                ->sortBy('student_name_kh')
                ->values();

            $is_print = 'Yes';

             return response()->json([
                'status' => 'success',
                'html' => view('general.attendance_sub_list', [
                    'is_print'=> $is_print,
                    'classCode'=> $classCode,
                    'semester'=> $semester,
                    'records' => $records,
                    'years' => $years,
                    'uniqueStudents' => $uniqueStudents,
                    'attendanceMonths' => $attendanceMonths,
                ])->render()
            ]);

        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());

            return response()->json([
                'status' => 'warning',
                'msg' => $ex->getMessage(),
            ]);
        }
    }
   public function attendanceList(Request $request)
   {

        $classCode = $request->input('class_code');
        $semester = $request->input('semester');
        $years = $request->input('years');

        try {
            $records = DB::table('student as s')
                ->selectRaw("
                    s.code as student_code,
                    s.name as student_name_en,
                    s.name_2 as student_name_kh,
                    s.gender,
                    ac.qualification,
                    s.class_code,
                    ac.semester,
                    ac.years,
                    ac.session_year_code,
                    GROUP_CONCAT(DISTINCT CONCAT(YEAR(sc.att_date), '-', LPAD(MONTH(sc.att_date), 2, '0')) ORDER BY YEAR(sc.att_date), MONTH(sc.att_date)) AS attended_months,
                    COUNT(CASE WHEN sc.att_score = 0 THEN 1 END) AS total_absent,
                    COUNT(CASE WHEN sc.att_score = 0.5 THEN 1 END) AS total_permission,
                    YEAR(sc.att_date) AS att_year,
                    MONTH(sc.att_date) AS att_month,
                    MIN(DAY(sc.att_date)) AS start_day,
                    MAX(DAY(sc.att_date)) AS end_day
                ")
                ->join('assing_classes as ac', 's.class_code', '=', 'ac.class_code')
                ->leftJoin('student_score as sc', function ($join) {
                    $join->on('sc.student_code', '=', 's.code')
                        ->on('sc.assign_line_no', '=', 'ac.assing_no');
                })
                ->when($classCode, fn($query) => $query->where('s.class_code', $classCode))
                ->when($semester, fn($query) => $query->where('ac.semester', $semester))
                ->when($years, fn($query) => $query->where('ac.years', $years))
                ->groupBy(
                    's.code',
                    's.name',
                    's.name_2',
                    's.gender',
                    'ac.qualification',
                    's.class_code',
                    'ac.semester',
                    'ac.years',
                    'att_year',
                    'att_month',
                    'ac.session_year_code',
                )
                ->orderBy('s.code')
                ->orderBy('att_year')
                ->orderBy('att_month')
                ->get();

            $attendanceMonths = $records
                ->filter(fn($item) => !is_null($item->att_year) && !is_null($item->att_month)) // REMOVE records with no attendance
                ->groupBy(function ($item) {
                    return $item->att_year . '-' . str_pad($item->att_month, 2, '0', STR_PAD_LEFT);
                })
                ->map(function ($items) {
                    return (object) [
                        'att_year' => $items->first()->att_year,
                        'att_month' => $items->first()->att_month,
                        'start_day' => $items->min('start_day'),
                        'end_day' => $items->max('end_day'),
                    ];
                })
                ->values();

            $uniqueStudents = $records
                ->groupBy('student_name_kh')
                ->map(fn($items) => $items->first())
                ->sortBy('student_name_kh')
                ->values();

            return view('general.attendance_list', [
                'records' => $records,
                'uniqueStudents' => $uniqueStudents,
                'attendanceMonths' => $attendanceMonths,
                'classCode' => $classCode,
                'semester' => $semester,
                'years' => $years,
            ]);

        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());

            return response()->json([
                'status' => 'warning',
                'msg' => $ex->getMessage(),
            ]);
        }
    }

   public function attendanceListExcel(Request $request)
    {
        $classCode = $request->input('class_code');
        $semester = $request->input('semester');
        $years = $request->input('years');

        $records = DB::table('student as s')
            ->selectRaw("
                s.code as student_code,
                s.name as student_name_en,
                s.name_2 as student_name_kh,
                s.gender,
                ac.qualification,
                s.class_code,
                ac.semester,
                sk.name_2 as skill_name,
                se.name_2 as section_name,
                ac.years,
                ac.session_year_code,
                GROUP_CONCAT(DISTINCT CONCAT(YEAR(sc.att_date), '-', LPAD(MONTH(sc.att_date), 2, '0')) ORDER BY YEAR(sc.att_date), MONTH(sc.att_date)) AS attended_months,
                COUNT(CASE WHEN sc.att_score = 0 THEN 1 END) AS total_absent,
                COUNT(CASE WHEN sc.att_score = 0.5 THEN 1 END) AS total_permission,
                YEAR(sc.att_date) AS att_year,
                MONTH(sc.att_date) AS att_month,
                MIN(DAY(sc.att_date)) AS start_day,
                MAX(DAY(sc.att_date)) AS end_day
            ")
            ->join('assing_classes as ac', 's.class_code', '=', 'ac.class_code')
            ->leftJoin('skills as sk', 'sk.code', 'ac.skills_code')
            ->leftJoin('sections as se', 'se.code', 'ac.sections_code')
            ->leftJoin('student_score as sc', function ($join) {
                $join->on('sc.student_code', '=', 's.code')
                    ->on('sc.assign_line_no', '=', 'ac.assing_no');
            })
            ->when($classCode, fn($query) => $query->where('s.class_code', $classCode))
            ->when($semester, fn($query) => $query->where('ac.semester', $semester))
            ->when($years, fn($query) => $query->where('ac.years', $years))
            ->groupBy(
                's.code',
                's.name',
                's.name_2',
                's.gender',
                'ac.qualification',
                's.class_code',
                'ac.semester',
                'ac.years',
                'att_year',
                'att_month',
                'sk.name_2',
                'se.name_2',
                'ac.session_year_code',
            )
            ->orderBy('s.code')
            ->orderBy('att_year')
            ->orderBy('att_month')
            ->get();

        $attendanceMonths = $records
            ->filter(fn($item) => !is_null($item->att_year) && !is_null($item->att_month))
            ->groupBy(function ($item) {
                return $item->att_year . '-' . str_pad($item->att_month, 2, '0', STR_PAD_LEFT);
            })
            ->map(function ($items) {
                return (object) [
                    'att_year' => $items->first()->att_year,
                    'att_month' => $items->first()->att_month,
                    'start_day' => $items->min('start_day'),
                    'end_day' => $items->max('end_day'),
                ];
            })
            ->values();

        $uniqueStudents = $records
            ->groupBy('student_name_kh')
            ->map(fn($items) => $items->first())
            ->sortBy('student_name_kh')
            ->values();

        return Excel::download(
            new AttendanceSemesterExport($records, $uniqueStudents, $attendanceMonths, $classCode, $semester, $years),
            'តារាងវត្តមានប្រចាំឆមាសទី​'.\App\Service\Service::convertToKhmerNumber($semester).'ថ្នាក់'.\App\Service\Service::removeDotFromCode($classCode).'.xlsx'
        );
    }
    public function attendenceListMonthly(Request $request)
    {
        $classCode = $request->input('class_code');
        $semester = $request->input('semester');
        $years = $request->input('years');
        $attYear = $request->input('att_year', now()->year);
        $attMonth = $request->input('att_month', now()->month);

        try {
            $records = DB::table('student as s')
                ->selectRaw("
                    s.code,
                    s.name_2,
                    s.gender,
                    s.class_code,
                    ac.semester,
                    ac.years,
                    ? AS att_year,
                    ? AS att_month,
                    ac.session_year_code,
                    COUNT(CASE WHEN sc.att_score = 0 THEN sc.att_date END) AS total_absent,
                    COUNT(CASE WHEN sc.att_score = 0.5 THEN sc.att_date END) AS total_permission,
                    MIN(DAY(sc.att_date)) AS start_day,
                    MAX(DAY(sc.att_date)) AS end_day
                ", [$attYear, $attMonth])
                ->join('assing_classes as ac', function ($join) use ($semester, $years) {
                    $join->on('s.class_code', '=', 'ac.class_code');
                    if ($semester) {
                        $join->where('ac.semester', '=', $semester);
                    }
                    if ($years) {
                        $join->where('ac.years', '=', $years);
                    }
                })
                ->leftJoin('student_score as sc', function ($join) use ($attYear, $attMonth) {
                    $join->on('sc.student_code', '=', 's.code')
                        ->on('sc.assign_line_no', '=', 'ac.assing_no')
                        ->whereYear('sc.att_date', '=', $attYear)
                        ->whereMonth('sc.att_date', '=', $attMonth);
                })
                ->when($classCode, fn($query) => $query->where('s.class_code', $classCode))
                ->groupBy(
                    's.code',
                    's.name_2',
                    's.gender',
                    's.class_code',
                    'ac.semester',
                    'ac.years',
                    'ac.session_year_code',
                )
                ->orderBy('s.code')
                ->get();
            
            $uniqueStudents = collect($records)
                ->groupBy('name_2')
                ->map(fn($items) => $items->first())
                ->values()
                ->sortBy(fn($student) => $student->name_2)
                ->values();

            return view('general.attendance_list_monthly', [
                'records' => $records,
                'uniqueStudents'=> $uniqueStudents,
                'attendanceMonths' => collect($records)
                    ->groupBy(fn($item) => "{$item->att_year}-" . str_pad($item->att_month, 2, '0', STR_PAD_LEFT))
                    ->map(fn($items) => (object)[
                        'att_month' => $items->first()->att_month,
                        'att_year' => $items->first()->att_year,
                        'start_day' => $items->min('start_day'),
                        'end_day' => $items->max('end_day'),
                    ])
                    ->values(),
                'classCode' => $classCode,
                'semester' => $semester,
                'years' => $years,
            ]);
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());

            return response()->json([
                'status' => 'warning',
                'msg' => $ex->getMessage(),
            ]);
        }
    }
     public function printAttedanceListMonthly(Request $request)
    {
        $classCode = $request->input('class_code');
        $semester = $request->input('semester');
        $years = $request->input('years');
        $attYear = $request->input('att_year', now()->year);
        $attMonth = $request->input('att_month', now()->month);

        try {
            $records = DB::table('student as s')
                ->selectRaw("
                    s.code,
                    s.name_2,
                    s.gender,
                    s.class_code,
                    ac.semester,
                    ac.years,
                    ac.qualification,
                    ac.session_year_code,
                    sk.name_2 as skill_name,
                    se.name_2 as section_name,              
                    ? AS att_year,
                    ? AS att_month,
                    COUNT(CASE WHEN sc.att_score = 0 THEN sc.att_date END) AS total_absent,
                    COUNT(CASE WHEN sc.att_score = 0.5 THEN sc.att_date END) AS total_permission,
                    MIN(DAY(sc.att_date)) AS start_day,
                    MAX(DAY(sc.att_date)) AS end_day
                ", [$attYear, $attMonth])
                    ->join('assing_classes as ac', function ($join) use ($semester, $years) {
                        $join->on('s.class_code', '=', 'ac.class_code');
                        if ($semester) {
                            $join->where('ac.semester', '=', $semester);
                        }
                        if ($years) {
                            $join->where('ac.years', '=', $years);
                        }
                    })
                ->leftJoin('student_score as sc', function ($join) use ($attYear, $attMonth) {
                    $join->on('sc.student_code', '=', 's.code')
                        ->on('sc.assign_line_no', '=', 'ac.assing_no')
                        ->whereYear('sc.att_date', '=', $attYear)
                        ->whereMonth('sc.att_date', '=', $attMonth);
                })
                ->leftJoin('skills as sk', 'sk.code', 'ac.skills_code')
                ->leftJoin('sections as se', 'se.code', 'ac.sections_code')
                ->when($classCode, fn($query) => $query->where('s.class_code', $classCode))
                ->groupBy(
                    's.code',
                    's.name_2',
                    's.gender',
                    's.class_code',
                    'ac.semester',
                    'ac.years',
                    'sk.name_2',
                    'se.name_2',
                    'ac.qualification',
                    'ac.session_year_code',
                )
                ->orderBy('s.code')
                ->get();

            $attendanceMonths = $records
                ->groupBy(fn($item) => "{$item->att_year}-" . str_pad($item->att_month, 2, '0', STR_PAD_LEFT))
                ->map(fn($items) => (object)[
                    'att_month' => $items->first()->att_month,
                    'att_year' => $items->first()->att_year,
                    'start_day' => $items->min('start_day'),
                    'end_day' => $items->max('end_day'),
                    ])
                ->values();
            $uniqueStudents = collect($records)
                ->groupBy('name_2')
                ->map(fn($items) => $items->first())
                ->values()
                ->sortBy(fn($student) => $student->name_2)
                ->values();
    
            $is_print = 'Yes';

            return response()->json([
                'status' => 'success',
                'html' => view('general.attendance_sub_list_monthly', [
                    'records' => $records,
                    'classCode' => $classCode,
                    'semester' => $semester,
                    'years' => $years,
                    'is_print' => $is_print,
                    'attendanceMonths' => $attendanceMonths,
                    'uniqueStudents' => $uniqueStudents
                ])->render(),
            ]);

        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());

            return response()->json([
                'status' => 'warning',
                'msg' => $ex->getMessage(),
            ]);
        }
    }
    public function downloadAttedanceListMonthly(Request $request)
    {
        $classCode = $request->input('class_code');
        $semester = $request->input('semester');
        $years = $request->input('years');
        $attYear = $request->input('att_year', now()->year);
        $attMonth = $request->input('att_month', now()->month);

        $records = DB::table('student as s')
            ->selectRaw("
                s.code,
                s.name_2,
                s.gender,
                s.class_code,
                ac.semester,
                ac.years,
                ac.qualification,
                ac.session_year_code,
                sk.name_2 as skill_name,
                se.name_2 as section_name,
                ? AS att_year,
                ? AS att_month,
                COUNT(CASE WHEN sc.att_score = 0 THEN sc.att_date END) AS total_absent,
                COUNT(CASE WHEN sc.att_score = 0.5 THEN sc.att_date END) AS total_permission,
                MIN(DAY(sc.att_date)) AS start_day,
                MAX(DAY(sc.att_date)) AS end_day
            ", [$attYear, $attMonth])
            ->join('assing_classes as ac', function ($join) use ($semester, $years) {
                $join->on('s.class_code', '=', 'ac.class_code');
                if ($semester) {
                    $join->where('ac.semester', '=', $semester);
                }
                if ($years) {
                    $join->where('ac.years', '=', $years);
                }
            })
            ->leftJoin('student_score as sc', function ($join) use ($attYear, $attMonth) {
                $join->on('sc.student_code', '=', 's.code')
                    ->on('sc.assign_line_no', '=', 'ac.assing_no')
                    ->whereYear('sc.att_date', '=', $attYear)
                    ->whereMonth('sc.att_date', '=', $attMonth);
            })
            ->leftJoin('skills as sk', 'sk.code', 'ac.skills_code')
            ->leftJoin('sections as se', 'se.code', 'ac.sections_code')
            ->when($classCode, fn($query) => $query->where('s.class_code', $classCode))
            ->groupBy(
                's.code',
                's.name_2',
                's.gender',
                's.class_code',
                'ac.semester',
                'ac.years',
                'sk.name_2',
                'se.name_2',
                'ac.qualification',
                'ac.session_year_code',
            )
            ->orderBy('s.code')
            ->get();

        $attendanceMonths = $records
            ->groupBy(fn($item) => "{$item->att_year}-" . str_pad($item->att_month, 2, '0', STR_PAD_LEFT))
            ->map(fn($items) => (object)[
                'att_month' => $items->first()->att_month,
                'att_year' => $items->first()->att_year,
                'start_day' => $items->min('start_day'),
                'end_day' => $items->max('end_day'),
            ])
            ->values();

        $uniqueStudents = collect($records)
            ->groupBy('name_2')
            ->map(fn($items) => $items->first())
            ->values()
            ->sortBy(fn($student) => $student->name_2)
            ->values();
        
        return Excel::download(
            new AttendanceMonthlyExport(
                $records, 
                $classCode, 
                $semester, 
                $years, 
                $attendanceMonths, 
                $uniqueStudents,
                $records->first()->qualification ?? '',
                $records->first()->skill_name ?? '',
                $records->first()->section_name ?? '',
                $records ->first()->session_year_code ?? ''),
             'តារាងវត្តមានប្រចាំខែ ' . \App\Service\Service::getMonthKhmer($attMonth - 1) . ' ថ្នាក់ ' . \App\Service\Service::removeDotFromCode($classCode) . '.xlsx'
        );
    }
    public function examCreditStudentList(Request $request)
    {
        try {
            $records = DB::table('student as s')
                ->selectRaw("
                    s.code,
                    s.name_2,
                    s.gender,
                    ac.semester,
                    ac.years,
                    sub.name,
                    ac.subjects_code,
                    s.class_code,
                    COUNT(CASE WHEN sc.att_score = 0 THEN sc.att_date END) AS total_absent,
                    COUNT(CASE WHEN sc.att_score = 0.5 THEN sc.att_date END) AS total_permission
                ")
                ->join('assing_classes as ac', 's.class_code', '=', 'ac.class_code')
                ->leftJoin('student_score as sc', function ($join) {
                    $join->on('sc.student_code', '=', 's.code')
                        ->on('sc.assign_line_no', '=', 'ac.assing_no');
                })
                ->join('subjects as sub', 'ac.subjects_code', '=', 'sub.code')
                ->groupBy(
                    's.code',
                    's.name_2',
                    's.gender',
                    's.class_code',
                    'ac.semester',
                    'ac.years',
                    'ac.subjects_code',
                    'sub.name',
                )
                ->havingRaw('COUNT(CASE WHEN sc.att_score = 0 THEN sc.att_date END) > ?', [3])
                ->orderBy('s.class_code', 'asc')
                ->get();

            $grouped = $records->groupBy('class_code');

            $studentCounts = $grouped->map(function ($students) {
                return count($students);
            });

            $classSubjects = DB::table('assing_classes as ac')
            ->join('subjects as sub', 'ac.subjects_code', '=', 'sub.code')
            ->select('ac.class_code', 'ac.semester', 'sub.name')
            ->get()
            ->groupBy(function ($item) {
                return $item->class_code . '_' . $item->semester;
            })
            ->map(function ($items) {
                return $items->pluck('name')->unique()->values();
            });

            return view('general.exam_credit_student_list', compact('records','studentCounts','classSubjects'));
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());

            return response()->json([
                'status' => 'warning',
                'msg' => $ex->getMessage(),
            ]);
        }
    }
    public function liveSearchAttendance(Request $request)
    {
        $searchData = trim($request->input('search_data_attendance'));

        $query = \App\Models\General\AssingClasses::with(['teacher', 'subject', 'skill', 'section'])
            ->selectRaw('MIN(id) as id, class_code, semester, years, session_year_code, qualification')
            ->groupBy('class_code', 'semester', 'years', 'session_year_code', 'qualification');

        if ($searchData) {
            $query->where(function ($q) use ($searchData) {
                $q->where('class_code', 'like', "%{$searchData}%")
                    ->orWhere('semester', 'like', "%{$searchData}%")
                    ->orWhere('years', 'like', "%{$searchData}%")
                    ->orWhere('session_year_code', 'like', "%{$searchData}%")
                    ->orWhere('qualification', 'like', "%{$searchData}%")
                    ->orWhereHas('skill', function ($q) use ($searchData) {
                        $q->where('name_2', 'like', "%{$searchData}%");
                    })
                    ->orWhereHas('section', function ($q) use ($searchData) {
                        $q->where('name_2', 'like', "%{$searchData}%");
                    })
                    ->orWhereHas('teacher', function ($q) use ($searchData) {
                        $q->where('name', 'like', "%{$searchData}%");
                    })
                    ->orWhereHas('subject', function ($q) use ($searchData) {
                        $q->where('name_2', 'like', "%{$searchData}%");
                    });
            });
        }

        // student count (must join manually since we lost withCount)
        $records = $query
            ->orderBy('years', 'asc')
            ->orderBy('semester', 'asc')
            ->paginate(10);

        return view('general.exam_credit_list', [
            'records' => $records,
            'isSearch' => true,
        ])->render();
    }

    public function printExamCreditStudentList(Request $request){
        $selectedSubjects = $request->input('selectedSubjects', []);
        try {
            $query = DB::table('student as s')
                ->selectRaw("
                    s.code,
                    s.name_2,
                    s.gender,
                    ac.semester,
                    ac.years,
                    sub.name,
                    ac.subjects_code,
                    s.class_code,
                    COUNT(CASE WHEN sc.att_score = 0 THEN sc.att_date END) AS total_absent,
                    COUNT(CASE WHEN sc.att_score = 0.5 THEN sc.att_date END) AS total_permission
                ")
                ->join('assing_classes as ac', 's.class_code', '=', 'ac.class_code')
                ->leftJoin('student_score as sc', function ($join) {
                    $join->on('sc.student_code', '=', 's.code')
                        ->on('sc.assign_line_no', '=', 'ac.assing_no');
                })
                ->join('subjects as sub', 'ac.subjects_code', '=', 'sub.code');

            if (!empty($selectedSubjects)) {
                $query->where(function ($q) use ($selectedSubjects) {
                    foreach ($selectedSubjects as $groupKey => $subjects) {
                        if (!is_array($subjects) || empty($subjects)) continue;

                        [$classCode, $semester] = explode('_', $groupKey);
                        $q->orWhere(function ($subQ) use ($classCode, $semester, $subjects) {
                            $subQ->where('ac.class_code', $classCode)
                                ->where('ac.semester', $semester)
                                ->whereIn('sub.name', $subjects);
                        });
                    }
                });
            }

            $records = $query->groupBy(
                's.code',
                's.name_2',
                's.gender',
                's.class_code',
                'ac.semester',
                'ac.years',
                'ac.subjects_code',
                'sub.name',
            )
                ->havingRaw('COUNT(CASE WHEN sc.att_score = 0 THEN sc.att_date END) > ?', [3])
                ->orderBy('s.class_code', 'asc')
                ->get();


            $grouped = $records->groupBy('class_code');

            $studentCounts = $grouped->map(function ($students) {
                return count($students);
            });

            $classSubjects = DB::table('assing_classes as ac')
                ->join('subjects as sub', 'ac.subjects_code', '=', 'sub.code')
                ->select('ac.class_code', 'ac.semester', 'sub.name')
                ->get()
                ->groupBy(function ($item) {
                    return $item->class_code . '_' . $item->semester;
                })
                ->map(function ($items) {
                    return $items->pluck('name')->unique()->values();
                });

            $is_print = 'Yes';
            return response()->json([
                'status'=>'success',
                'html'=>view('general.exam_credit_student_sub_list', [
                    'records' => $records,
                    'studentCounts' => $studentCounts,
                    'classSubjects' => $classSubjects,
                    'is_print' => $is_print,
                    'selectedSubjects' => $selectedSubjects,
                ])->render()
            ]);

        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());

            return response()->json([
                'status' => 'warning',
                'msg' => $ex->getMessage(),
            ]);
        }
    }
    public function assignScore(Request $request)
    {
        $selectedSubjects = $request->input('selectedSubjects');
        $students = $request->input('students');

        session([
            'selectedSubjects' => $selectedSubjects,
            'students' => $students
        ]);

        return response()->json([
            'status' => 'success',
            'redirect_url' => route('exam-credit.assign-score.preview')
        ]);
    }
    public function assignScorePreview(Request $request)
    {
         $students = session('students') ?? [];
         $selectedSubjects = session('selectedSubjects') ?? [];

         return view('general.exam_credit_assign_score', compact('students', 'selectedSubjects'));
    }
    public function printAssignScore(Request $request)
    {
        $students = $request->input('students', []);
        $is_print = 'Yes';
        return response()->json([
            'status' => 'success',
            'html' => view('general.exam_credit_assign_score_sub_list', [
                'students' => $students,
                'is_print' => $is_print,
            ])->render()
        ]);
    }
    public function assignScoreExcel(Request $request)
    {
        $students = $request->input('students', []);

        return Excel::download(new ExamCreditScoringExport($students),'តារាងពិន្ទុប្រឡងក្រេឌីត_' . now()->format('d_m_Y') . '.xlsx');
    }                   

}
