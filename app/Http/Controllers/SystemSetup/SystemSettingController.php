<?php

namespace App\Http\Controllers\SystemSetup;
use Exception;
use App\Http\Controllers\Controller;
use App\Models\General\Skills;
use App\Models\General\Subjects;
use App\Models\General\Teachers;
use App\Models\Student\Student;
use App\Models\SystemSetup\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Service\service;
use Illuminate\Support\Facades\Auth;

class SystemSettingController extends Controller
{
    public $service;
    public $page;
    public $page_id;
    function __construct() {
        $this->service = new service();
    }
    public function pageSearch (Request $request)
    {
        $input = $request->all();
        $strings = explode(" ", strtoupper($input['string']));
        $search_value = '';
        if (count($strings) > 0) {
            if ($strings[0] == 'NEW' || $strings[0] == 'OPEN') {
                if (count($strings) > 2) {
                    for ($i = 1; $i < count($strings) - 1; $i++) {
                        $search_value .= $strings[$i] . " ";
                    }
                } else {
                    if (count($strings) == 2) {
                        $search_value = $strings[1];
                    }
                }
                $search_value = rtrim($search_value, " ");
                $menus = DB::table('page')->where('title', 'like', $search_value . "%")->where('url_link', '<>', null)->get();
             
                if (count($menus) > 0) 
                {
                    foreach ($menus as $menu) {
                        if ($strings[0] == 'OPEN' && count($strings) > 2) {
                            $menu->code = $menu->code . ' ' . $strings[count($strings) - 1];
                        }
                        $menu->url = $menu->url . ($strings[0] == 'NEW' ? "type=cr" : "type=ed&code=" . $this->service->Encr_string($strings[count($strings) - 1]));
                    }
                }
            }else{
                for ($i = 0; $i < count($strings); $i++) {
                    $search_value .= $strings[$i] . " ";
                }
                $search_value = rtrim($search_value, " ");
                $menus = DB::table('page')->where('title', 'like', $search_value . "%")->where('url_link', '<>', null)->get();
            }
            if (count($menus) > 0) {
                return view('system.menu_search_list', compact('menus'));
            }
        }
        return 'none';
    }
    public function AvanceSearch(Request $request,$page){
        try {
            $class_record = null;
            $data = $request->all();
            if($page == 'student') $page = 'student';
            if($page == 'users') $page = 'users';
            if($page == 'location') $page = 'location';
            $extract_query = $this->service->extractQuery($data);
            $link_record = null;
            switch($page){
                case 'student':
                    if($data['class_code'] != null ){
                        $records = Student::where('class_code', $data['class_code'])->paginate(1000);
                    }
                    $records = Student::whereRaw($extract_query)->paginate(1000);
                    $blade_file_record = 'general.student_list';
                break;
                case 'department':
                    $records = Department::whereRaw($extract_query)->paginate(1000);
                    $blade_file_record = 'department.department_list';
                break;
                case 'skills':
                    $records = Skills::whereRaw($extract_query)->paginate(1000);
                    $blade_file_record = 'general.skills_lists';
                break;
                case 'subjects':
                    $records = Subjects::whereRaw($extract_query)->paginate(1000);
                    $blade_file_record = 'general.subjects_lists';
                break;
                case 'teachers':
                    $records = Teachers::whereRaw($extract_query)->paginate(1000);
                    $blade_file_record = 'general.teachers_lists';
                break;
                case 'warehouses':
                    // $records = WarehouseModel::whereRaw($extract_query)->paginate(15);
                    break;
                
                default:
               
                    break; 
            }
            $view = view($blade_file_record,compact('records','class_record'))->render();
            return response()->json(['status' =>'success','view' =>$view]);
        } catch (Exception $ex){
            $this->service->telegram($ex->getMessage(),$page,$ex->getLine());
            return response()->json(['status' => 'warning' , 'msg' => $ex->getMessage()]);
        }
    }
    public function LiveSearch (Request $request,$page)
    {
        $input = $request->all();
        $strings = explode(" ", strtoupper($input['string']));
        $search_value = '';
        $user = Auth::user();
        if (count($strings) > 0) {
            if ($strings[0] == 'NEW' || $strings[0] == 'OPEN') {
                if (count($strings) > 2) {
                    for ($i = 1; $i < count($strings) - 1; $i++) {
                        $search_value .= $strings[$i] . " ";
                    }
                } else {
                    if (count($strings) == 2) {
                        $search_value = $strings[1];
                    }
                }
                $search_value = rtrim($search_value, " ");
                // check page
                if($page == 'student'){
                    $menus = DB::table('student')->where('name','like', $search_value . "%")
                                ->orWhere('code', 'like', $search_value . "%")
                                ->orWhere('name_2', 'like', $search_value . "%")
                                ->where('class_code', '<>', null)->get();
                    $blade_file_record = 'general.student_list';
                }else if($page == 'department'){
                    $menus = DB::table('department')->where('name','like', $search_value . "%")
                                ->orWhere('code', 'like', $search_value . "%")
                                ->orWhere('name_2', 'like', $search_value . "%")
                                ->where('id', '<>', null)->get();
                    $blade_file_record = 'department.department_list';
                }else if($page == 'classes'){
                    $menus = Skills::where('name_2','like', $search_value . "%")
                        ->orWhere('code', 'like', $search_value . "%")
                        ->orWhere('name', 'like', $search_value . "%")
                        ->where('code', '<>', null)->get();
                    $blade_file_record = 'general.classes_lists';
                }else if($page == 'skills'){
                    $menus = Skills::where('name_2','like', $search_value . "%")
                        ->orWhere('code', 'like', $search_value . "%")
                        ->orWhere('name', 'like', $search_value . "%")
                        ->where('code', '<>', null)->get();
                    $blade_file_record = 'general.skills_lists';
                }else if ($page == 'subjects'){
                    $menus = Subjects::where('name','like', $search_value . "%")
                            ->orWhere('code', 'like', $search_value . "%")
                            ->orWhere('name_2', 'like', $search_value . "%")
                            ->where('code', '<>', null)->get();
                    $blade_file_record = 'general.subjects_lists';
                }else if ($page == 'teachers'){
                    $menus = Teachers::where('name','like', $search_value . "%")
                            ->orWhere('code', 'like', $search_value . "%")
                            ->orWhere('name_2', 'like', $search_value . "%")
                            ->where('code', '<>', null)->get();
                    $blade_file_record = 'general.teachers_lists';
                }

                if (count($menus) > 0) {
                    foreach ($menus as $menu) {
                        if ($strings[0] == 'OPEN' && count($strings) > 2) {
                            $menu->code = $menu->code . ' ' . $strings[count($strings) - 1];
                        }
                        $menu->url = $menu->url . ($strings[0] == 'NEW' ? "type=cr" : "type=ed&code=" . $this->service->Encr_string($strings[count($strings) - 1]));
                    }
                }
            }else{
                for ($i = 0; $i < count($strings); $i++) {
                    $search_value .= $strings[$i] . " ";
                }
                $search_value = rtrim($search_value, " ");
                if($page == 'student'){
                    $menus = DB::table('student')->where('name', 'like', $search_value . "%")
                                ->orWhere('code', 'like', $search_value . "%")
                                ->orWhere('name_2', 'like', $search_value . "%")
                                ->where('class_code', '<>', null)->paginate(1000);
                    $blade_file_record = 'general.student_list';
                }else if($page == 'department'){
                    $menus = DB::table('department')->where('name','like', $search_value . "%")
                                ->orWhere('code', 'like', $search_value . "%")
                                ->orWhere('name_2', 'like', $search_value . "%")
                                ->where('id', '<>', null)->paginate(1000);
                    $blade_file_record = 'department.department_list';
                }else if($page == 'classes'){
                    $menus = DB::table('classes')->where('name','like', $search_value . "%")
                                ->orWhere('code', 'like', $search_value . "%")
                                ->orWhere('name_2', 'like', $search_value . "%")
                                ->where('code', '<>', null)->paginate(1000);
                    $blade_file_record = 'general.classes_lists';
                }else if($page == 'skills'){
                    $menus = Skills::where('name','like', $search_value . "%")
                            ->orWhere('code', 'like', $search_value . "%")
                            ->orWhere('name_2', 'like', $search_value . "%")
                            ->where('code', '<>', null)->paginate(1000);
                    $blade_file_record = 'general.skills_lists';
                }else if($page == 'subjects'){
                    $menus = DB::table('subjects')->where('name','like', $search_value . "%")
                            ->orWhere('code', 'like', $search_value . "%")
                            ->orWhere('name_2', 'like', $search_value . "%")
                            ->where('code', '<>', null)->paginate(1000);
                    $blade_file_record = 'general.subjects_lists';
                }else if($page == 'teachers'){
                    $menus = DB::table('teachers')->where('name','like', $search_value . "%")
                            ->orWhere('code', 'like', $search_value . "%")
                            ->orWhere('name_2', 'like', $search_value . "%")
                            ->where('code', '<>', null)->paginate(1000);
                    $blade_file_record = 'general.teachers_lists';
                }
            }
        
            if (count($menus) > 0) {
                $records = $menus;
            }else{
                if($page == 'student'){
                    $records = Student::where('department_code',$user->childs)->paginate(10);
                }else if($page == 'department'){
                    $records = Department::where('code', null)->paginate(1000);
                }else if($page == 'classes'){
                    $records = DB::table('classes')->where('code', null)->paginate(1000);
                }else if($page == 'skills'){
                    $records = DB::table('skills')->where('code', null)->paginate(1000);
                }else if($page == 'subjects'){
                    $records = DB::table('subjects')->where('code', null)->paginate(1000);
                }else if($page == 'teachers'){
                    $records = Teachers::where('code', null)->paginate(1000);
                }
            }
            $view = view($blade_file_record,compact('records'))->render();
            return response()->json(['status' =>'success','view' =>$view]);
        }
        return 'none';
    }
    
}
