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
            // Get total count of skills and classes
            $total_skill = Skills::count(); // Using count() directly instead of get()->count()
            $total_class = Classes::count(); // Similarly for classes
            $total_students = Student::count();
            $sections = Sections::get();


            // Que ry for aggregated skill data, including gender-based counts
            $results = Skills::selectRaw(
                'skills.name_2, 
                COUNT(student.gender) AS total_students, 
                SUM(CASE WHEN student.gender = "ស្រី" THEN 1 ELSE 0 END) AS total_f, 
                SUM(CASE WHEN student.gender = "ប្រុស" THEN 1 ELSE 0 END) AS total_m'
            )
                ->leftJoin('student', 'student.skills_code', '=', 'skills.code',)
                ->groupBy('skills.name_2', 'skills.code')
                ->get();

            $total_students_year = DB::table('session_year as sy')
                ->select(
                    'sy.code as year_code',
                    'sy.name as year_name',
                    DB::raw('COUNT(st.name) as total_students'),
                    DB::raw("COUNT(CASE WHEN st.gender = 'ប្រុស' THEN 1 END) as total_male_students"),
                    DB::raw("COUNT(CASE WHEN st.gender = 'ស្រី' THEN 1 END) as total_female_students")
                )
                ->join('student as st', 'st.session_year_code', '=', DB::raw("sy.code COLLATE utf8mb4_unicode_ci"))
                ->groupBy('sy.code', 'sy.name')
                ->orderBy('sy.code')
                ->orderBy('sy.name')
                ->get();
            //ss
            $total_departments = DB::table('department as dm')
                ->selectRaw(
                    'dm.name_2 AS department_name, 
                    COUNT(st.gender) AS total_students, 
                    SUM(CASE WHEN st.gender = "ស្រី" THEN 1 ELSE 0 END) AS total_female_students, 
                    SUM(CASE WHEN st.gender = "ប្រុស" THEN 1 ELSE 0 END) AS total_male_students'
                )
                ->leftJoin('student as st', 'st.department_code', '=', 'dm.code')
                ->groupBy('dm.name_2')
                ->get();



            $total_results = DB::table('department as dt')
                ->select(
                    'dt.name_2',
                    DB::raw('COUNT(st.name_2) as total_studentss'),
                    DB::raw('SUM(CASE WHEN st.sections_code = "A" THEN 1 ELSE 0 END) as aa_1'),
                    DB::raw('SUM(CASE WHEN st.sections_code = "M" THEN 1 ELSE 0 END) as mm_1'),
                    DB::raw('SUM(CASE WHEN st.sections_code = "N" THEN 1 ELSE 0 END) as nn_1')
                )
                ->leftJoin('student as st', 'st.department_code', '=', 'dt.code')
                ->groupBy('dt.name_2', 'dt.code')
                ->get();



            // $total_provinces = DB::table('student')
            //     ->select(
            //         DB::raw("SUBSTRING(student_address, LOCATE('ខេត្ត', student_address)) AS province"),
            //         DB::raw("COUNT(*) AS total_provinces"),
            //         DB::raw("COUNT(*) AS total_students")
            //     )
            //     ->groupBy(DB::raw("SUBSTRING(student_address, LOCATE('ខេត្ត', student_address))"))
            //     ->orderByDesc(DB::raw("COUNT(*)"))
            //     ->get();

        
            $total_provinces = DB::table('student')
            ->selectRaw("
                CASE 
                    WHEN student_address LIKE '%ភ្នំពេញ%' THEN 'ភ្នំពេញ'
                    WHEN student_address LIKE '%ព្រៃវែង%' THEN 'ព្រៃវែង'
                    WHEN student_address LIKE '%កំពត%' THEN 'កំពត'
                    WHEN student_address LIKE '%កំពង់ឆ្នាំង%' THEN 'កំពង់ឆ្នាំង'
                    WHEN student_address LIKE '%បន្ទាយមានជ័យ%' THEN 'បន្ទាយមានជ័យ'
                    WHEN student_address LIKE '%សៀមរាប%' THEN 'សៀមរាប'
                    WHEN student_address LIKE '%ព្រះវិហារ%' THEN 'ព្រះវិហារ'
                    WHEN student_address LIKE '%កំពង់ចាម%' THEN 'កំពង់ចាម'
                    WHEN student_address LIKE '%កំពង់ស្ពឺ%' THEN 'កំពង់ស្ពឺ'
                    WHEN student_address LIKE '%ពោធិ៍សាត់%' OR student_address LIKE '%ពោធិសាត់%' THEN 'ពោធិ៍សាត់'
                    WHEN student_address LIKE '%កណ្ដាល%' THEN 'កណ្ដាល'
                    WHEN student_address LIKE '%ស្វាយរៀង%' THEN 'ស្វាយរៀង'
                    WHEN student_address LIKE '%កែប%' THEN 'កែប'
                    WHEN student_address LIKE '%បាត់ដំបង%' THEN 'បាត់ដំបង'
                    WHEN student_address LIKE '%ក្រចេះ%' THEN 'ក្រចេះ'
                    WHEN student_address LIKE '%រតនគីរី%' THEN 'រតនគីរី'
                    WHEN student_address LIKE '%ត្បូងឃ្មុំ%' THEN 'ត្បូងឃ្មុំ'
                    WHEN student_address LIKE '%កំពង់ធំ%' THEN 'កំពង់ធំ'
                    WHEN student_address LIKE '%តាកែវ%' THEN 'តាកែវ'
                    WHEN student_address LIKE '%កោះកុង%' THEN 'កោះកុង'
                    WHEN student_address LIKE '%ប៉ៃលិន%' THEN 'ប៉ៃលិន'
                    WHEN student_address LIKE '%ព្រះសីហនុ%' THEN 'ព្រះសីហនុ'
                    WHEN student_address LIKE '%មណ្ឌលគិរី%' THEN 'មណ្ឌលគិរី'
                    WHEN student_address LIKE '%ស្ទឹងត្រែង%' THEN 'ស្ទឹងត្រែង'
                    WHEN student_address LIKE '%ឧត្តរមានជ័យ%' THEN 'ឧត្តរមានជ័យ'
                    ELSE 'ផ្សេងៗ'
                END AS province, COUNT(*) AS total_students
            ")
            ->groupBy('province')
            ->orderByRaw("FIELD(province, 
                'កណ្ដាល', 'កំពង់ចាម', 'កំពង់ឆ្នាំង', 'កំពង់ធំ', 'កំពង់ស្ពឺ', 
                'កំពត', 'កែប', 'កោះកុង', 'ក្រចេះ', 'តាកែវ', 'ត្បូងឃ្មុំ', 
                'បន្ទាយមានជ័យ', 'បាត់ដំបង', 'ប៉ៃលិន', 'ពោធិ៍សាត់', 
                'ព្រះវិហារ', 'ព្រះសីហនុ', 'ព្រៃវែង', 'ភ្នំពេញ', 'មណ្ឌលគិរី', 
                'រតនគីរី', 'សៀមរាប', 'ស្ទឹងត្រែង', 'ស្វាយរៀង', 'ឧត្តរមានជ័យ', 
                'ផ្សេងៗ'
            )")
            ->get();
        


            // Prepare labels for chart data
            $data = $total_students_year->map(function ($item) {
                $item->label = "ឆ្នាំសិក្សា {$item->year_code} សិស្សសរុប {$item->total_students} នាក់ ស្រី {$item->total_female_students} ប្រុស {$item->total_male_students}";
                return $item;
            });


            // Prepare additional data for the view (like records and types)
            $records = $results;  // You can assign your results to 'records'
            $type = 'skills';  // Example value, you can set your own type

            // Return the view with data
            return view('dashboard.dashboard', compact('total_skill', 'results', 'sections', 'total_students_year', 'total_departments', 'total_skill', 'total_class', 'total_students', 'data', 'total_results', 'total_provinces'));
        } catch (\Exception $ex) {
            // If any exception occurs, roll back the transaction (if started) and log the error
            DB::rollBack();
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());

            // Return a response with the error message
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

     
            $records = Student::where('code', $request->code)->first();

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

            // dd($schedules_recored);

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

       
        $records = AssingClasses::where('teachers_code',$filter['code'])->get();

        return view('dashboard.dashboard_teacher_management_class', array_merge($data, compact('records', 'type')));
        // return view('dashboard.dashboard_teacher_management_class', compact('records'));
    }
}
