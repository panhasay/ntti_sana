<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\General\StudentRegistration;
use Illuminate\Http\Request;

use App\Models\Student\Student;
use App\Models\SystemSetup\Department;
use App\Service\service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;


class ReportFirstYearStudentRegistrationController extends Controller
{
    public $services;
    public  $page;
    public $page_id = "000020";
    function __construct()
    {
        $this->services = new service();
        $this->page = 'eports-list-of-student';
    }
    public function index()
    {
            $type = null;
        try {
            $department = Department::get();
            $today = Carbon::today()->toDateString(); // Get today's date in YYYY-MM-DD format

            $records = StudentRegistration::select(
                'qualification',
                'apply_year',
                'skills_code',
                DB::raw('COUNT(code) AS total_count'), // Total count
                DB::raw('SUM(CASE WHEN gender = "ស្រី" THEN 1 ELSE 0 END) AS total_count_girl'), // Count girls
                DB::raw('SUM(CASE WHEN DATE(register_date) = "' . $today . '" THEN 1 ELSE 0 END) AS total_count_today'), // Total registered today
                DB::raw('SUM(CASE WHEN DATE(register_date) = "' . $today . '" AND gender = "ស្រី" THEN 1 ELSE 0 END) AS total_count_today_girl'), // Girls registered today
                DB::raw('SUM(CASE WHEN register_date > "' . $today . ' 23:59:59" THEN 1 ELSE 0 END) AS total_count_before_today'), // Total registered before or on today
                DB::raw('SUM(CASE WHEN register_date > "' . $today . ' 23:59:59" AND gender = "ស្រី" THEN 1 ELSE 0 END) AS total_count_before_today_girl') // Girls registered before or on today
            )
            ->where('study_type', 'new student')
            ->groupBy('qualification', 'apply_year', 'skills_code') // Grouping by necessary fields
            ->get()
            ->groupBy(['qualification', 'apply_year']); // Group by in Laravel Collection

            // dd($records);

            return view('reports.report_first_year_student_registration', compact('records', 'department','type'));	
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->services->telegram($ex->getMessage(), 'report list Of student', $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function Priview(Request $request){
        try {
            $fliter = $request->all();
            $type = $fliter['type'];
            $class_record = null;
            $extract_query = $this->services->extractQuery($fliter);
            if($fliter['department_id']){
                $creterial_department = 'department.id='.$fliter['department_id'];  
            }else{
                $creterial_department = '1=1';
            }
            if($fliter['session_id']){
                $creterial_years =  'sessions.id='.$fliter['session_id']; 
            }else{
                $creterial_years = '1=1'; 
            }
            if($fliter['category_id']){
                $creterial_category =  'categories.id='.$fliter['category_id']; 
            }else{
                $creterial_category = '1=1'; 
            }
            if($fliter['class_id']){
                $creterial_class =  'classes.id='.$fliter['class_id']; 
            }else{
                $creterial_class = '1=1'; 
            }
            $GroupBy_category = $fliter['group_by_category'];
            $link_record = null;

            $records= DB::table('classes')
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
                ->whereRaw($creterial_department)
                ->whereRaw($creterial_years)
                ->whereRaw($creterial_category)
                ->whereRaw($creterial_class)
                ->groupBy('sections.section', 'classes.class', 'department.department_name', 'sessions.session', 'categories.category')
                ->orderBy('classes.class', 'asc')
                ->get();
            if (isset($GroupBy_category)) {
                $records = $records->groupBy('category');
            }
            $parmas = ['records','class_record','type', 'GroupBy_category'];
            if($type == 'print'){
                return view('reports.report_list_of_student_list', compact($parmas));
            }
            if($type == 'downlaodexcel'){
                $token = openssl_random_pseudo_bytes(10); // Random SSL value for generate file name
                $token = bin2hex($token); // convert to hex
                $save_to_path = 'export';
                $param = [
                    'records' => $records,
                    'excel' => true,
                    'type' => $type
            ];
            $file_path = "export-list-students.xlsx";
            if (!file_exists($save_to_path)) mkdir($save_to_path, 0777, true);
                $http = $request->getSchemeAndHttpHost();
                $result = Excel::store(new ExportData($param), "$file_path",'local');
                $url =  "$http/app/$file_path";
            if (!$result)   return response()->json(['status' => 'warning', 'msg' => 'Something went wrong']);
            return response()->json(['status' => 'success', 'msg' => 'Successfully export excell', 'path' => $url]);
            }
            
            $view = view('reports.report_list_of_student_list',compact($parmas))->render();
            return response()->json(['status' =>'success','view' =>$view]);
        } catch (\Exception $ex){
            $this->services->telegram($ex->getMessage(),'list of student',$ex->getLine());
            return response()->json(['status' => 'warning' , 'msg' => $ex->getMessage()]);
        }
    }
    


}
