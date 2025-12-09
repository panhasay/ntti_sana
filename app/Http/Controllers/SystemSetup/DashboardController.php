<?php

namespace App\Http\Controllers\SystemSetup;

use App\Http\Controllers\Controller;
use App\Models\General\AssingClasses;
use App\Models\General\Classes;
use Illuminate\Http\Request;
use App\Service\service;
use App\Models\Student\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\General\Teachers;
use App\Models\General\ClassSchedule;
use App\Models\General\Picture;
use App\Models\General\Sections;
use App\Models\General\Skills;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public $services;
    public  $page;
    function __construct()
    {
        $this->services = new service();
        $this->page = 'eports-list-of-student';
    }
    public function index()
    {
        try {
            $total_skills = DB::table('skills')->count();
            $total_classes = DB::table('classes')->count();
            $total_student = DB::table('student')->count();
            $total_departments = DB::table('department')->count();

            $studentCounts = DB::table('session_year as sy')
                ->leftJoin('student as s', function ($join) {
                    $join->on(DB::raw("s.session_year_code COLLATE utf8mb4_general_ci"), '=', DB::raw("sy.code COLLATE utf8mb4_general_ci"));
                })
                ->select(
                    'sy.name',
                    'sy.code',
                    DB::raw("COUNT(CASE WHEN study_type = 'new student' THEN 1 END) as new_student_registration"),
                    DB::raw("COUNT(CASE WHEN s.study_type = 'new student' AND s.gender = 'ស្រី' THEN 1 END) as new_female_registration"),
                    DB::raw('COUNT(s.id) as total_students'),
                    DB::raw("COUNT(CASE WHEN s.gender = 'ស្រី' THEN 1 END) as total_female"),
                )
                ->groupBy('sy.name', 'sy.code')
                ->get();

            $student_per_department = DB::table('department as d')
                ->leftJoin('student as s', 's.department_code', '=', 'd.code')
                ->select(
                    'd.name_2 as department',
                    DB::raw("COUNT(CASE WHEN study_type = 'new student' THEN 1 END) as new_student_registration"),
                    DB::raw("COUNT(CASE WHEN s.study_type = 'new student' AND s.gender = 'ស្រី' THEN 1 END) as new_female_registration"),
                    DB::raw('COUNT(s.id) as total_students'),
                    DB::raw("COUNT(CASE WHEN s.gender = 'ស្រី' THEN 1 END) as total_female"),
                )
                ->groupBy('d.name_2')
                ->get();

            $student_per_skill = DB::table('skills as ski')
                ->leftJoin('student as s', 's.skills_code', '=', 'ski.code')
                ->select(
                    'ski.name_2',
                    DB::raw("COUNT(CASE WHEN study_type = 'new student' THEN 1 END) as new_student_registration"),
                    DB::raw("COUNT(CASE WHEN s.study_type = 'new student' AND s.gender = 'ស្រី' THEN 1 END) as new_female_registration"),
                    DB::raw('COUNT(s.id) as total_students'),
                    DB::raw("COUNT(CASE WHEN s.gender = 'ស្រី' THEN 1 END) as total_female"),
                )
                ->groupBy('ski.name_2')
                ->get();

            $student_province = DB::table('student')
                ->select(
                    DB::raw('COUNT(s.id) as total_students'),
                    DB::raw("COUNT(CASE WHEN s. = 'ស្រី' THEN 1 END) as total_female"),
                );

            $student_per_province = DB::table('student')
                ->select('bakdop_province', DB::raw('COUNT(*) as total_students'))
                ->groupBy('bakdop_province')
                ->orderBy('total_students', 'desc')
                ->get();

            return view('dashboard.dashboard', compact('studentCounts', 'total_skills', 'total_classes', 'total_student', 'total_departments', 'student_per_department', 'student_per_skill', 'student_per_province'));
        } catch (\Exception $ex) {

            DB::rollBack();
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());

            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function Print(Request $request)
    {
        try {
            $data = $request->all();
            $type = $data['type'];
            if ($type == 'skill') {
                $records = DB::table('students as student')
                    ->join('categories as category', 'category.id', '=', 'student.category_id')
                    ->selectRaw("category.category
                    ,COUNT(student.firstname) as qty_studen
                    ,COUNT(CASE WHEN student.gender = 'ស្រី' THEN student.firstname END) as qty_studen_female
                    ,COUNT(CASE WHEN student.gender = 'ប្រុស' THEN student.firstname END) as qty_studen_male
                    ")
                    ->groupBy('category.category')
                    ->get();
            } else if ($type == 'year') {
                $records = DB::table('students as sd')
                    ->join('student_session as sds', 'sds.student_id', '=', 'sd.id')
                    ->join('classes as cl', 'cl.id', '=', 'sds.class_id')
                    ->join('sessions as ss', 'ss.id', '=', 'sds.session_id')
                    ->selectRaw("ss.session
                    ,COUNT(sd.firstname) as qty_studen
                    ,COUNT(CASE WHEN sd.gender = 'ស្រី' THEN sd.firstname END) as qty_studen_female
                    ,COUNT(CASE WHEN sd.gender = 'ប្រុស' THEN sd.firstname END) as qty_studen_male
                    ")
                    ->groupBy('ss.session')
                    ->get();
            } else if ($type == 'department') {
                $records = DB::table('students as sd')
                    ->join('student_session as sds', 'sds.student_id', '=', 'sd.id')
                    ->join('classes as cl', 'cl.id', '=', 'sds.class_id')
                    ->join('sessions as ss', 'ss.id', '=', 'sds.session_id')
                    ->join('department as dp', 'dp.id', '=', 'cl.depart_id')
                    ->selectRaw("dp.department_name
                    ,COUNT(sd.firstname) as qty_studen
                    ,COUNT(CASE WHEN sd.gender = 'ស្រី' THEN sd.firstname END) as qty_studen_female
                    ,COUNT(CASE WHEN sd.gender = 'ប្រុស' THEN sd.firstname END) as qty_studen_male
                    ")
                    ->groupBy('dp.department_name')
                    ->get();
            }
            return view('dashboard.dashboard_print', compact('records', 'type'));
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }

    public function StudentUserAccount(Request $request)
    {
        try {
            $data = $request->all();

            $code = Auth::user()->user_code;
            $records = Student::where('code', $code)->first();

            // dd($records);

            $skills = DB::table('skills')->where('code', $records->skills_code ?? '')->first();
            $qualification = DB::table('qualification')->where('code', $records->qualification ?? '')->first();
            $imgs = Picture::where('code', $records->code ?? '')->first();
            return view('dashboard.dashboard_student', compact('records', 'skills', 'qualification', 'imgs'));
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }

    public function teacherDashboard()
    {
        $record = Teachers::where('code', Auth::user()->user_code)->first();
        if (!$record) {
            $record = (object) ['name' => 'No Teacher Available'];
        }
        $total_class = AssingClasses::where('teachers_code', $record->code)->count();
        $total_subject = AssingClasses::where('teachers_code', $record->code)
            ->Groupby('subjects_code')->count();
        $schedules = ClassSchedule::with(['section', 'subject'])
            ->whereDate('start_date', '<=', Carbon::now())
            ->orderBy('start_date', 'asc')
            ->get();
        // Extract class_schedule IDs as an array
        $class_schedule_ids = $schedules->pluck('id')->toArray();
        $date_name  = $schedules->pluck('date_name')->toArray();

        $today = strtolower(Carbon::now()->format('l'));
        // Fetch assigned classes with matching class_schedule_ids and teacher's code
        $assignedClasses = AssingClasses::whereIn('class_schedule_id', $class_schedule_ids)
            ->where('teachers_code', $record->code)
            ->where('date_name', $today)
            ->get();
        $Classes_history = AssingClasses::where('teachers_code', $record->code)
            ->get();
        $schedules_recored = AssingClasses::with(['section', 'subject', 'teacher', 'skill'])
            ->where('teachers_code', $record->code)
            ->get();

        $daysKhmer = [
            'monday'    => 'ច័ន្ទ',
            'tuesday'   => 'អង្គារ',
            'wednesday' => 'ពុធ',
            'thursday'  => 'ព្រហស្បតិ៍',
            'friday'    => 'សុក្រ',
            'saturday'  => 'សៅរ៍',
            'sunday'    => 'អាទិត្យ',
        ];

        return view('dashboard.dashboard_teacher', compact('record', 'daysKhmer', 'total_class', 'total_subject', 'assignedClasses', 'Classes_history', 'schedules_recored'));
    }
    public function TeacherMmanagementClass(Request $request)
    {
        $filter = $request->all();
        $type = $filter['type'] ?? '';
        $data = $this->services->GetDateIndexOption(now());

        $records = AssingClasses::where('teachers_code', $filter['code'])->get();

        return view('dashboard.dashboard_teacher_management_class', array_merge($data, compact('records', 'type')));
    }
    public function dahhboardInter(Request $request)
    {
        try {
            $data = $request->all();
            $code = Auth::user()->user_code;
            $records = Student::where('code', $code)->first();
            // dd($records);
            $skills = DB::table('skills')->where('code', $records->skills_code ?? '')->first();
            $qualification = DB::table('qualification')->where('code', $records->qualification ?? '')->first();
            $imgs = Picture::where('code', $records->code ?? '')->first();
            return view('dashboard.dashboard_inputer', compact('records', 'skills', 'qualification', 'imgs'));
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
}
