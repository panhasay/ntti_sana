<?php

namespace App\Http\Controllers\Report;
use App\Exports\ExportData;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Models\Student\Student;
use App\Service\service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PSpell\Config;

class ListOfStudentController extends Controller
{
    public $services;
    public  $page;
    public $page_id = "000010";
    function __construct()
    {
        $this->services = new service();
        $this->page = 'eports-list-of-student';
    }
    public function index()
    
    {
            $type = null;
        try {
            $records = Student::where('id', '=', 'null')->get();
            $department = DB::table('department')->get();
            $sessions = DB::table('sessions')->get();
            $categories = DB::table('categories')->get();
            $classes = DB::table('classes')->get();
            if(Auth::check()){
                return view('reports.report_list_of_studnet', compact('records', 'department','type', 'sessions', 'categories', 'classes'));	
            }else{
                return redirect("login")->withSuccess('Opps! You do not have access');
            }   
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
    public function export(Request $request) 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
