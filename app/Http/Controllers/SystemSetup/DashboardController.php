<?php

namespace App\Http\Controllers\SystemSetup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\service;
use App\Models\Student\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $user = Auth::user();
        if(isset($user->role) && $user->role == 'student'){
            return redirect("user-dont-have-permission")->withSuccess('Opps! You do not have access');
        }
            $type = null;
        try {
            $records_student_by_skills = DB::table('students as student')
                            ->join('categories as category', 'category.id', '=', 'student.category_id')
                            ->selectRaw("category.category
                            ,COUNT(student.firstname) as qty_studen
                            ,COUNT(CASE WHEN student.gender = 'ស្រី' THEN student.firstname END) as qty_studen_female
                            ,COUNT(CASE WHEN student.gender = 'ប្រុស' THEN student.firstname END) as qty_studen_male
                            ")
                            ->groupBy('category.category')
                            ->get();
            $records_student_by_year = DB::table('students as sd')
                            ->join('student_session as sds', 'sds.student_id', '=', 'sd.id')
                            ->join('classes as cl', 'cl.id', '=', 'sds.class_id')
                            ->join('sessions as ss', 'ss.id', '=','sds.session_id')
                            ->selectRaw("ss.session
                            ,COUNT(sd.firstname) as qty_studen
                            ,COUNT(CASE WHEN sd.gender = 'ស្រី' THEN sd.firstname END) as qty_studen_female
                            ,COUNT(CASE WHEN sd.gender = 'ប្រុស' THEN sd.firstname END) as qty_studen_male
                            ")
                            ->groupBy('ss.session')
                            ->get();
            $records_student_by_department = DB::table('students as sd')
                            ->join('student_session as sds', 'sds.student_id', '=', 'sd.id')
                            ->join('classes as cl', 'cl.id', '=', 'sds.class_id')
                            ->join('sessions as ss', 'ss.id', '=','sds.session_id')
                            ->join('department as dp', 'dp.id', '=','cl.depart_id')
                            ->selectRaw("dp.department_name
                            ,COUNT(sd.firstname) as qty_studen
                            ,COUNT(CASE WHEN sd.gender = 'ស្រី' THEN sd.firstname END) as qty_studen_female
                            ,COUNT(CASE WHEN sd.gender = 'ប្រុស' THEN sd.firstname END) as qty_studen_male
                            ")
                            ->groupBy('dp.department_name')
                            ->get();
            $records_student_Department_Class_and_Ssections= DB::table('classes')
                            ->join('class_sections', 'classes.id', '=', 'class_sections.class_id')
                            ->join('sections', 'sections.id', '=', 'class_sections.section_id')
                            ->join('student_session', 'student_session.class_id', '=', 'classes.id')
                            ->join('students', 'student_session.student_id', '=', 'students.id')
                            ->join('department', 'department.id', '=', 'classes.depart_id')
                            ->join('sessions', 'sessions.id', '=', 'student_session.session_id')
                            ->join('categories', 'categories.id', '=', 'students.category_id')
                            ->selectRaw("classes.class, sections.section, department.department_name, sessions.session, categories.category
                                ,COUNT(students.firstname) as qty_studen
                                ,COUNT(CASE WHEN students.gender = 'ស្រី' THEN students.firstname END) as qty_studen_female
                                ,COUNT(CASE WHEN students.gender = 'ប្រុស' THEN students.firstname END) as qty_studen_male
                            ")
                            ->groupBy('sections.section', 'classes.class', 'department.department_name', 'sessions.session', 'categories.category')
                            ->orderBy('classes.class', 'asc')
                            ->get();
            // dd($results);
            
            $records_total_student = DB::table('students')->select(DB::raw('COUNT(firstname) as total'))->get();
            $total_students = $records_total_student[0]->total;
            $records_total_class = DB::table('classes')->select(DB::raw('COUNT(class) as total'))->get();
            $total_class = $records_total_class[0]->total;
            $records_total_skill = DB::table('categories')->select(DB::raw('COUNT(category) as total'))->get();
            $total_skill = $records_total_skill[0]->total;
            $sections = DB::table('sections')->get();
            
            $department = DB::table('department')->get();
            $sessions = DB::table('sessions')->get();
            if(Auth::check()){
                return view('dashboard.dashboard', compact( 'records_student_by_skills',
                'records_student_by_year','records_student_by_department','department','type',
                'sessions','total_students','total_class','total_skill','sections','records_student_Department_Class_and_Ssections'));	
            }else{
                return redirect("login")->withSuccess('Opps! You do not have access');
            }   
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->services->telegram($ex->getMessage(), 'report list Of student', $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function Print(Request $request)
    {
        try {
            $data = $request->all();
            $type = $data['type'];
            if($type == 'skill'){
                $records = DB::table('students as student')
                    ->join('categories as category', 'category.id', '=', 'student.category_id')
                    ->selectRaw("category.category
                    ,COUNT(student.firstname) as qty_studen
                    ,COUNT(CASE WHEN student.gender = 'ស្រី' THEN student.firstname END) as qty_studen_female
                    ,COUNT(CASE WHEN student.gender = 'ប្រុស' THEN student.firstname END) as qty_studen_male
                    ")
                    ->groupBy('category.category')
                    ->get();
            }else if($type == 'year'){
                $records = DB::table('students as sd')
                    ->join('student_session as sds', 'sds.student_id', '=', 'sd.id')
                    ->join('classes as cl', 'cl.id', '=', 'sds.class_id')
                    ->join('sessions as ss', 'ss.id', '=','sds.session_id')
                    ->selectRaw("ss.session
                    ,COUNT(sd.firstname) as qty_studen
                    ,COUNT(CASE WHEN sd.gender = 'ស្រី' THEN sd.firstname END) as qty_studen_female
                    ,COUNT(CASE WHEN sd.gender = 'ប្រុស' THEN sd.firstname END) as qty_studen_male
                    ")
                    ->groupBy('ss.session')
                    ->get();
            }else if($type == 'department'){
                $records = DB::table('students as sd')
                    ->join('student_session as sds', 'sds.student_id', '=', 'sd.id')
                    ->join('classes as cl', 'cl.id', '=', 'sds.class_id')
                    ->join('sessions as ss', 'ss.id', '=','sds.session_id')
                    ->join('department as dp', 'dp.id', '=','cl.depart_id')
                    ->selectRaw("dp.department_name
                    ,COUNT(sd.firstname) as qty_studen
                    ,COUNT(CASE WHEN sd.gender = 'ស្រី' THEN sd.firstname END) as qty_studen_female
                    ,COUNT(CASE WHEN sd.gender = 'ប្រុស' THEN sd.firstname END) as qty_studen_male
                    ")
                    ->groupBy('dp.department_name')
                    ->get();
            }
            return view('dashboard.dashboard_print', compact('records','type'));
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }

    public function StudentUserAccount(Request $request){
        try {
            $data = $request->all();
            $records = Student::where('code',Auth::user()->user_code ?? $request->code)->first();

            $skills = DB::table('skills')->where('code',$records->skills_code ?? '')->first();
            return view('dashboard.dashboard_student', compact('records', 'skills'));
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
}
