<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\General\AssingClasses;
use App\Models\General\AssingClassesStudentLine;
use App\Models\General\Classes;
use App\Models\General\ClassSchedule as GeneralClassSchedule;
use App\Models\General\Skills;
use App\Models\General\StudyYears;
use App\Models\General\Subjects;
use App\Models\General\Teachers;
use App\Models\SystemSetup\Department;
use App\Service\service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Models\General\ClassSchedule;
use function PHPSTORM_META\type;
class ClassScheduleController extends Controller
{
    //
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
        $this->page = "class-schedule";
        $this->prefix = "class-schedule";
        $this->arrayJoin = ['10001', '10007', '10008'];
        $this->table_id = "10005";
    }
    // public function index()
    // {
    //     if (!Auth::check()) {
    //         return redirect("login")->withSuccess('Opps! You do not have access');
    //     }
    //     $user =  Auth::user();
    //     $page = $this->page;
    //     $records = GeneralClassSchedule::orderBy('semester', 'desc')
    //         ->orderBy('years', 'desc');
    //     $records = $this->services->filterByUser($records, $user);
    //     $records = $records->get();

    //     $data = $this->services->GetDateIndexOption(now()); 
    //     return view('general.class_schedule', array_merge($data, compact('page', 'records')));
    // }
    // public function transaction(request $request)
    // {
    //     $sessionYearCode = Auth::user()->session_year_code ?? null;
    //     $data = $request->all();
    //     $type = $data['type'];
    //     $page = $this->page;
    //     $page_url = $this->page;
    //     $records = null;

    //     $record_sub_lines = AssingClasses::where('class_code', $data['type'])->get();

    //     $classs = Classes::WithQueryPermissionTeacher()->orderBy('code', 'desc');
    //     if (!empty($sessionYearCode)) {
    //         $classs = $classs->where('school_year_code', $sessionYearCode);
    //     }
    //     $classs = $classs->get();
        
    //     $sections = DB::table('sections')->get();
    //     $department = Department::get();
    //     $school_years = DB::table('session_year')->orderBy('code', 'desc')->get();
    //     $skills = DB::table('skills')->get();
    //     $study_years = StudyYears::get();
    //     $teachers = Teachers::WhitQueryPermission()->orderByRaw("name_2 COLLATE utf8mb4_general_ci")->get();
    //     $subjects = Subjects::orderBy('code', 'asc')->get();
    //     $date_name = DB::table('date_name')->orderBy('index', 'asc')->get();
    //     $days = $date_name->pluck('name')->toArray();
    //     $qualification = DB::table('qualification')->get();

    //     try {
    //         $params = ['records', 'type', 'page', 'sections', 'department', 'school_years', 'skills', 'classs', 'study_years', 'teachers', 'subjects', 'record_sub_lines', 'date_name', 'days', 'qualification'];
    //         if ($type == 'cr') return view('general.class_schedule_card', compact($params));
    //         if (isset($_GET['code'])) {
    //             $records = GeneralClassSchedule::where('id', $this->services->Decr_string($_GET['code']))->first();
    //             $record_sub_lines = AssingClasses::where('class_code', $records->class_code)
    //                 ->where('semester', $records->semester)
    //                 ->where('years', $records->years)
    //                 ->where('qualification', $records->qualification)
    //                 ->where('sections_code', $records->sections_code)
    //                 ->where('skills_code', $records->skills_code)
    //                 ->where('department_code', $records->department_code)
    //                 ->get();
    //         }
    //         return view('general.class_schedule_card', compact($params));
    //     } catch (\Exception $ex) {
    //         $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
    //         return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
    //     }
    // }
    // public function delete(Request $request)
    // {
    //     $code = $request->code;
    //     try {
    //         $records = GeneralClassSchedule::where('id', $code)->first();
    //         $assing_class = AssingClasses::where('class_schedule_id', $records->id)->Get();
    //         if(count($assing_class) > 0){
    //             return response()->json(['status' => 'warning', 'msg' => 'ទិន្ន័យមិនអាច លុប​បានទេ មានទិន្ន័យគ្រូ ចំនួន'. count($assing_class). 'សូចចុច Open']);
    //         }
    //         $records->delete();
    //         DB::commit();
    //         return response()->json(['status' => 'success', 'msg' => 'ទិន្ន័យត្រូវបាន លុប​!']);
    //     } catch (\Exception $ex) {
    //         $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
    //         return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
    //     }
    // }
    // public function DeleteLine(Request $request)
    // {
    //     $code = $request->code;
    //     try {
            
    //         DB::beginTransaction();
    //         $records = AssingClasses::where('id', $code)->first();
    //         $assing_class_line = AssingClassesStudentLine::where('assing_line_no', $records->assing_no)->Get();
    //         if(count($assing_class_line) > 0){
    //             return response()->json(['status' => 'warning', 'msg' => 'ទិន្ន័យមិនអាច លុប​បានទេ មានទិន្ន័យសិស្ស ចំនួន'. count($assing_class_line). 'នាក់']);
    //         }
    //         if (!$records->exists()) {
    //             return response()->json(['status' => 'warning', 'msg' => 'Record not found!']);
    //         }
    //         $records->delete();
    //         DB::commit();
    //         return response()->json(['status' => 'success', 'msg' => 'ទិន្ន័យត្រូវបាន លុប​!']);
    //     } catch (\Exception $ex) {
    //         DB::rollback();
    //         $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
    //         return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
    //     }
    // }
    // public function update(Request $request)
    // {
    //     $input = $request->all();
    //     $code = $input['type'];
    //     $record = GeneralClassSchedule::where('id', $code)->first();
    //     if (!$record) return response()->json(['status' => 'error', 'msg' => "មិនអាចកែប្រ លេខកូដ!"]);
    //     try {
    //         $records = GeneralClassSchedule::where('id', $code)->first();
    //         if ($records) {
    //             $records->start_date = $request->start_date;
    //             $records->sections_code = $request->sections_code;
    //             $records->skills_code = $request->skills_code;
    //             $records->department_code = $request->department_code;
    //             $records->session_year_code = $request->school_year_code;
    //             $records->qualification = $request->level;
    //             $records->semester = $request->semester;
    //             $records->class_code = $request->class_code;
    //             $records->years = $request->years;
    //             $records->update();
    //         }
    //         return response()->json(['status' => 'success', 'msg' => 'បច្ចុប្បន្នភាព ទិន្នន័យជោគជ័យ!', '$records' => $records]);
    //     } catch (\Exception $ex) {
    //         $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
    //         return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
    //     }
    // }
    // public function store(request $request)
    // {
    //     $input = $request->all();
    //     $requiredFields = [
    //         'start_date' => 'ចាប់ផ្តើមអនុវត្ត ត្រូវបំពេញ!',
    //         'class_code' => 'ថា្នក់/ក្រុម​ ត្រូវបំពេញ!',
    //         'sections_code' => 'វេន ត្រូវបំពេញ!',
    //         'skills_code' => 'ជំនាញ ត្រូវបំពេញ!',
    //         'department_code' => 'ដេប៉ាតឺម៉ង់ ត្រូវបំពេញ!',
    //         'school_year_code' => 'ឆ្នាំសិក្សា ត្រូវបំពេញ!',
    //         'level' => 'Level is ត្រូវបំពេញ!',
    //         'semester' => 'Semester is ត្រូវបំពេញ!',
    //         'years' => 'ត្រូវបំពេញ បរិញាប័ត្រ ឆ្នាំ !'
    //     ];
    //     foreach ($requiredFields as $field => $message) {
    //         if (empty($input[$field])) {
    //             return response()->json(['status' => 'error', 'msg' => $message]);
    //         }
    //     }

    //     $exists = GeneralClassSchedule::where('class_code', $request->class_code)
    //             ->where('semester', $request->semester)
    //             ->where('years', $request->years)
    //             ->exists();
    //     if ($exists) {
    //          return response()->json(['status' => 'error', 'msg' => 'ថ្នាក់ ឆមាស និងឆ្នាំដូចគ្នា រួចហើយ!']);
    //     }
    //     try {
    //         $records = new GeneralClassSchedule();
    //         $records->start_date = $request->start_date;
    //         $records->sections_code = $request->sections_code;
    //         $records->skills_code = $request->skills_code;
    //         $records->department_code = $request->department_code;
    //         $records->session_year_code = $request->school_year_code;
    //         $records->qualification = $request->level;
    //         $records->semester = $request->semester;
    //         $records->class_code = $request->class_code;
    //         $records->years = $request->years;
    //         $records->save();

    //         $record = GeneralClassSchedule::latest('id')->first();
    //         if (isset($record->id)) {
    //             $encryptedCode = \App\Service\service::Encr_string($record->id);
    //             $url = "/class-schedule/transaction?type=ed&code=" . $encryptedCode;
    //         }
    //         return response()->json(['store' => 'yes', 'url' => $url, 'msg' => 'Records Add Succesfully !!']);
    //     } catch (\Exception $ex) {
    //         DB::rollBack();
    //         $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
    //         return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
    //     }
    // }
    // public function printLine(Request $request)
    // {
    //     $data = $request->all();
    //     $is_print = "yes";
    //     $date_name = DB::table('date_name')->orderBy('index', 'asc')->get();
    //     $days = $date_name->pluck('name')->toArray();
    //     try {
    //         $records = GeneralClassSchedule::where('id', $this->services->Decr_string($_GET['code']))->first();
    //         $record_sub_lines = AssingClasses::where('class_code', $records->class_code)
    //             ->where('semester', $records->semester)
    //             ->where('years', $records->years)
    //             ->where('qualification', $records->qualification)
    //             ->where('sections_code', $records->sections_code)
    //             ->where('skills_code', $records->skills_code)
    //             ->where('department_code', $records->department_code)
    //             ->get();
    //         return view('general.class_schedule_sub_lists', compact('records', 'record_sub_lines', 'is_print', 'date_name', 'days'));
    //     } catch (\Exception $ex) {
    //         DB::rollBack();
    //         $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
    //         return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
    //     }
    // }
    // public function SaveSchedule(Request $request)
    // {
    //     $data = $request->all();

    //     $id = $this->services->Decr_string($data['code']);
    //     $header = GeneralClassSchedule::where('id', $id)->first();
    //     $requiredFields = [
    //         'teachers_code' => 'សាស្រ្តាចារ្យ​ ត្រូវបំពេញ!',
    //         'subjects_code' => 'មុខវិជ្ជា​ ត្រូវបំពេញ!',
    //         'date_name' => 'ថ្ងៃបង្រៀន ត្រូវបំពេញ!',
    //     ];

    //     foreach ($requiredFields as $field => $message) {
    //         if (empty($data[$field])) {
    //             return response()->json(['status' => 'error', 'msg' => $message]);
    //         }
    //     }

    //     $assing = AssingClasses::latest('id')->first();

    //     if ($assing) {
    //         $assing_no = $assing->assing_no + 10;
    //     } else {
    //         $assing_no = 10;
    //     }
    //     try {
    //         if (isset($data['dataId']) && $data['dataId']) {
    //             $records = AssingClasses::where('class_schedule_id', $id)->where('id', $data['dataId'])->first();

    //             $assing_class_line = AssingClassesStudentLine::where('assing_line_no', $records->assing_no)->Get();
    //             if(count($assing_class_line) > 0){
    //                 return response()->json(['status' => 'error', 'msg' => 'ទិន្ន័យមិនអាច ក្រែប្រែ​បានទេ មានទិន្ន័យសិស្ស ចំនួន'. count($assing_class_line). 'នាក់']);
    //             }

    //             $records->room = $request->room;
    //             $records->teachers_code = $request->teachers_code;
    //             $records->date_name = $request->date_name;
    //             $records->start_time = $request->start_time;
    //             $records->end_time = $request->end_time;
    //             $records->subjects_code = $request->subjects_code;
    //             $records->sessions_type = $request->sessions_type;
    //             $records->update();

    //             $is_print = "No";
    //             $date_name = DB::table('date_name')->orderBy('index', 'asc')->get();
    //             $days = $date_name->pluck('name')->toArray();
    //             $records = GeneralClassSchedule::where('id', $id)->first();
    //             $record_sub_lines = AssingClasses::where('class_code', $records->class_code)
    //                 ->where('semester', $records->semester)
    //                 ->where('years', $records->years)
    //                 ->where('qualification', $records->qualification)
    //                 ->where('sections_code', $records->sections_code)
    //                 ->where('skills_code', $records->skills_code)
    //                 ->where('department_code', $records->department_code)
    //                 ->get();

    //             if ($is_print == 'Yes') {
    //                 $view = view('general.class_schedule_sub_lists', compact('records', 'days', 'record_sub_lines', 'is_print'))->render();
    //                 return response()->json(['status' => 'success', 'msg' => 'Data Udpate successfully', 'view' => $view]);
    //             } else {
    //                 $view = view('general.class_schedule_sub_lists', compact('records', 'days', 'record_sub_lines'))->render();
    //                 return response()->json(['status' => 'success', 'msg' => 'Data Udpate successfully', 'view' => $view]);
    //             }
    //         } else {
    //             $records = new AssingClasses();
    //             $records->class_schedule_id = $header->id;
    //             $records->assing_no = $assing_no;
    //             $records->teachers_code = $request->teachers_code;
    //             $records->class_code = $header->class_code;
    //             $records->sections_code = $header->sections_code;
    //             $records->skills_code = $header->skills_code;
    //             $records->department_code = $header->department_code;
    //             $records->session_year_code = $header->session_year_code;
    //             $records->subjects_code = $request->subjects_code;
    //             $records->status = $request->status;
    //             $records->semester = $header->semester;
    //             $records->qualification = $header->qualification;
    //             $records->years = $header->years;

    //             $records->room = $request->room;
    //             $records->date_name = $request->date_name;
    //             $records->start_time = $request->start_time;
    //             $records->end_time = $request->end_time;
    //             $records->sessions_type = $request->sessions_type;
    //             $records->save();

    //             $is_print = "No";
    //             $date_name = DB::table('date_name')->orderBy('index', 'asc')->get();
    //             $days = $date_name->pluck('name')->toArray();
    //             $records = GeneralClassSchedule::where('id', $id)->first();
    //             $record_sub_lines = AssingClasses::where('class_code', $records->class_code)
    //                 ->where('semester', $records->semester)
    //                 ->where('years', $records->years)
    //                 ->where('qualification', $records->qualification)
    //                 ->where('sections_code', $records->sections_code)
    //                 ->where('skills_code', $records->skills_code)
    //                 ->where('department_code', $records->department_code)
    //                 ->get();

    //             if ($is_print == 'Yes') {
    //                 $view = view('general.class_schedule_sub_lists', compact('records', 'days', 'record_sub_lines', 'is_print'))->render();
    //                 return response()->json(['status' => 'success', 'msg' => 'Data add successfully', 'view' => $view]);
    //             } else {
    //                 $view = view('general.class_schedule_sub_lists', compact('records', 'days', 'record_sub_lines'))->render();
    //                 return response()->json(['status' => 'success', 'msg' => 'Data add successfully', 'view' => $view]);
    //             }
    //         }
    //     } catch (\Exception $ex) {
    //         DB::rollBack();
    //         $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
    //         return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
    //     }
    // }
    // public function EditTeacherSchedule(Request $request)
    // {
    //     $data = $request->all();
    //     try {
    //         $subjects = Subjects::orderBy('code')->get();
    //         $teachers = Teachers::orderBy('code')->get();
    //         $records = AssingClasses::with(['subject', 'teacher'])->where('id',  $data['id'])->first();

    //         // dd($records);
    //         return response()->json(['status' => 'success', 'records' => $records, 'subjects' => $subjects, 'teachers' => $teachers]);
    //     } catch (\Exception $ex) {
    //         DB::rollBack();
    //         $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
    //         return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
    //     }
    // }
    // public function Search(Request $request, $page)
    // {
    //     dd("helo");
    //     $input = $request->all();
    //     $strings = explode(" ", strtoupper($input['string']));
    //     $search_value = '';
    //     $user = Auth::user();
    //     if (count($strings) > 0) {
    //         if ($strings[0] == 'NEW' || $strings[0] == 'OPEN') {
    //             if (count($strings) > 2) {
    //                 for ($i = 1; $i < count($strings) - 1; $i++) {
    //                     $search_value .= $strings[$i] . " ";
    //                 }
    //             } else {
    //                 if (count($strings) == 2) {
    //                     $search_value = $strings[1];
    //                 }
    //             }
    //             $search_value = rtrim($search_value, " ");
    //             // check page
    //             if ($page == 'student') {
    //                 $menus = DB::table('student')->where('name', 'like', $search_value . "%")
    //                     ->orWhere('code', 'like', $search_value . "%")
    //                     ->orWhere('name_2', 'like', $search_value . "%")
    //                     ->where('class_code', '<>', null)->get();
    //                 $blade_file_record = 'student.student_list';
    //             } else if ($page == 'department') {
    //                 $menus = DB::table('department')->where('department_name', 'like', $search_value . "%")
    //                     ->where('id', '<>', null)->get();
    //                 $blade_file_record = 'department.department_list';
    //             }

    //             if (count($menus) > 0) {
    //                 foreach ($menus as $menu) {
    //                     if ($strings[0] == 'OPEN' && count($strings) > 2) {
    //                         $menu->code = $menu->code . ' ' . $strings[count($strings) - 1];
    //                     }
    //                     $menu->url = $menu->url . ($strings[0] == 'NEW' ? "type=cr" : "type=ed&code=" . $this->service->Encr_string($strings[count($strings) - 1]));
    //                 }
    //             }
    //         } else {
    //             for ($i = 0; $i < count($strings); $i++) {
    //                 $search_value .= $strings[$i] . " ";
    //             }
    //             $search_value = rtrim($search_value, " ");
    //             if ($page == 'student') {
    //                 $menus = DB::table('student')->where('name', 'like', $search_value . "%")
    //                     ->orWhere('code', 'like', $search_value . "%")
    //                     ->orWhere('name_2', 'like', $search_value . "%")
    //                     ->where('class_code', '<>', null)->paginate(1000);
    //                 $blade_file_record = 'student.student_list';
    //             } else if ($page == 'department') {
    //                 $menus = DB::table('department')->where('department_name', 'like', $search_value . "%")
    //                     ->where('id', '<>', null)->paginate(1000);
    //                 $blade_file_record = 'department.department_list';
    //             }
    //         }

    //         if (count($menus) > 0) {
    //             $records = $menus;
    //         } else {
    //             if ($page == 'student') {
    //                 $records = Student::where('department_code', $user->childs)->paginate(10);
    //             } else if ($page == 'department') {
    //                 $records = Department::paginate(15);
    //             }
    //         }
    //         $view = view($blade_file_record, compact('records'))->render();
    //         return response()->json(['status' => 'success', 'view' => $view]);
    //     }
    //     return 'none';
    // }
    // public function DownlaodexcelLine(Request $request)
    // {
    //     try {
    //         $filter = $request->all();

    //         dd($filter);
    //         $header = null;
    //         $department = $filter['department_code'];
    //         $department = Department::where('code', $department)->first();
    //         if ($department){
    //             $department = $department->name_2;
    //         }
    //         $skills = $filter['skills_code'];
    //         $skills = Skills::where('code', $skills)->first();
    //         if ($skills){
    //             $skills = $skills->name_2;
    //         }
    //         $sections = $filter['sections_code'];
    //         $sections = Sections::where('code', $sections)->first();
    //         if ($sections){
    //             $sections = $sections->name_2;
    //         }
    //         $qualification = $filter['qualification'];
    //         $qualification = Qualifications::where('code', $qualification)->first();
    //         if ($qualification) {
    //             $qualification = $qualification->name_2;
    //         }

    //         $extract_query = $this->services->extractQuery($filter);
           
    //         // Use get() instead of paginate() for exporting
    //         $records = Student::whereRaw($extract_query)
    //         ->where('study_type', 'new student')
    //         ->orderBy('class_code')
    //         ->orderBy('department_code')
    //         ->orderByRaw("name_2 COLLATE utf8mb4_general_ci")
    //         ->get()
    //         ->map(function ($record) {
    //             $record->skills = DB::table('skills')->where('code', $record->skills_code)->value('name_2');
    //             $record->classes = DB::table('classes')->where('code', $record->class_code)->value('name');
    //             $record->section = DB::table('sections')->where('code', $record->sections_code)->value('name_2');
    //             $record->gender = $record->gender;
    //             $record->department = DB::table('department')->where('code', $record->department_code)->value('name_2');
    //             $record->khmerDate = service::DateFormartKhmer($record->date_of_birth);
    //             $record->year_student = service::calculateDateDifference($record->posting_date);
    //             $record->picture = Picture::where('code', $record->code)
    //                 ->where('type', 'student')
    //                 ->value('picture_ori');
    //             return $record;
    //         });


    //         $blade_download = "general.student_register_lists_excel";

    //         // Create an instance of ExportData and pass the necessary parameters
    //         return Excel::download(new ExportData($records, $blade_download, $department, $sections, $skills, $qualification, $header), 'registration.xlsx');

    //         return response()->json(['status' =>'success','view' =>$view]);
    //     } catch (\Exception $ex){
    //         $this->services->telegram($ex->getMessage(),'list of student',$ex->getLine());
    //         return response()->json(['status' => 'warning' , 'msg' => $ex->getMessage()]);
    //     }
    // }

    public function classScheduleV2()
    {
          if (!Auth::check()) {
            return redirect("login")->withSuccess('Opps! You do not have access');
        }
        $user =  Auth::user();
        $page = $this->page;
        
        $class_schedule = GeneralClassSchedule::orderBy('semester', 'desc')
            ->orderBy('years', 'desc');
        $class_schedule = $this->services->filterByUser($class_schedule, $user);
        $class_schedule = $class_schedule->get();

        $data = $this->services->GetDateIndexOption(now()); 

        return view ('general.class_schedule_v2',compact('class_schedule'));
    }
    public function classScheduleList($id)
    {

        $headers = DB::table('class_schedule as class_schedule')
        ->select(
                'class_schedule.*',
                'sections.name_2 as section_name',
                'department.name_2 as department_name',
                'skills.name_2 as skill_name'
            )
            ->join('sections', 'class_schedule.sections_code', '=', 'sections.code')
            ->join('department', 'class_schedule.department_code', '=', 'department.code')
            ->join('skills', 'class_schedule.skills_code', '=', 'skills.code')
            ->where('class_schedule.id', $id)
            ->first();

        // dd($headers);

        $records = DB::table('assing_classes')->where('class_schedule_id', $id)->get();

        $days = [];
        $sessions = [];

        if ($records->isNotEmpty()) {
            $days = [];
            $sessions = [];
            $dayCodes = $records->pluck('date_name')->unique()->toArray();
            $days = DB::table('date_name')
                ->whereIn('code', $dayCodes)
                ->orderBy('index', 'asc')
                ->pluck('name_2', 'code')
                ->toArray();
        
            $sectionCode = $records->first()->sections_code;
            $sessionsRaw = DB::table('session')
                ->where('section_code', $sectionCode)
                ->select('name', 'start_time', 'end_time')
                ->get();

            $sessions = [];
                foreach ($records as $rec) {
                    $day = $rec->date_name;
                    $sessionKey = $rec->start_time . '-' . $rec->end_time;
                    
                    $teacher = DB::table('teachers')
                        ->where('code', $rec->teachers_code)
                        ->select('name_2', 'gender')
                        ->first();

                    $sessions[$day][$sessionKey] = [
                        'id' => $rec->id,
                        'teacher_name' => $teacher->name_2 ?? '',
                        'teacher_gender' => $teacher->gender ?? '',
                        'subject_name' => DB::table('subjects')
                            ->where('code', $rec->subjects_code)
                            ->value('name_2'),
                        'room' => $rec->room,
                    ];
                }
        }

        $classs = DB::table('classes')->get();
        return view('general.class_schedule_v2_list', compact('records', 'days', 'sessions', 'classs', 'headers'));
    }   
    public function deleteClassSchedule($id)
    {
        $exists = DB::table('assing_classes')
            ->where('class_schedule_id', $id)
            ->where('class_schedule_id', '>', 0)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'មិនអាចលុបបានទេ ព្រោះថ្នាក់នេះបញ្ចូលកាលវិភាគរួចហើយ។'
            ]);
        }

        $deleted = DB::table('class_schedule')->where('id', $id)->delete();

        if ($deleted) {
            return response()->json([
                'success' => true,
                'message' => 'បានលុបទិន្នន័យដោយជោគជ័យ'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'មិនអាចលុបបានទេ'
            ]);
        }
    }
    public function classScheduleStoreV2view(Request $request)
    {
        $user =  Auth::user();
        $page = $this->page;

        $classes = DB::table('v_class_current')->orderBy('semester', 'desc')
            ->orderBy('years', 'desc');
        $classes = $this->services->filterByUser($classes, $user);
          $classes = $classes->get();

        if ($classes) {
            $sessionYearCode = Auth::user()->session_year_code ?? null;
            // Start query
            $classes = DB::table('classes')
                ->selectRaw("code as class_code, name");
            // Filter by school year code
            if (!empty($sessionYearCode)) {
                $classes = $classes->where('school_year_code', $sessionYearCode);
            }
            
            if(!empty(Auth::user()->department_code)){
                $classes = $classes->where('department_code', Auth::user()->department_code);
            }
          
            // Add ordering
            $classes = $classes
                ->orderBy('semester', 'desc')
                ->orderBy('years', 'desc')
                ->get();
        }

       

        if(@$request->type){

            $exists = DB::table('class_schedule')
                ->where('class_code', $request->class_code)
                ->exists();

            if ($exists) {
                return response()->json([
                    'success' => false,
                    'exists' => true,
                    'message' => 'ថ្នាក់នេះបានបង្កើតរួចហើយ!'
                ]);
            }else{
                $classes = DB::table('v_class_current as vcc')->where('class_code', $request->class_code)
                    ->join('department as de','vcc.department_code','=','de.code')
                    ->join('sections as se','vcc.sections_code','=','se.code')
                    ->join('skills as ski','vcc.skills_code','=','ski.code')
                    ->select(
                        'vcc.*',
                        'de.name_2 as department_name',
                        'se.name_2 as section_name',
                        'ski.name_2 as skill_name'
                    )
                    ->orderBy('semester', 'desc')
                    ->orderBy('years', 'desc')
                    ->first();

                if(empty($classes)){
                    $classes = DB::table('classes as vcc')
                    ->select(
                        'vcc.*',
                        'de.name_2 as department_name',
                        'se.name_2 as section_name',
                        'ski.name_2 as skill_name',
                        'vcc.level as qualification',
                        'vcc.school_year_code as session_year_code'
                    )
                    ->join('department as de', 'vcc.department_code', '=', 'de.code')
                    ->join('sections as se', 'vcc.sections_code', '=', 'se.code')
                    ->join('skills as ski', 'vcc.skills_code', '=', 'ski.code')
                    ->where('vcc.code', $request->class_code)
                    ->orderBy('vcc.semester', 'DESC')
                    ->orderBy('vcc.years', 'DESC')
                    ->first(); 
                  
                }
                return response()->json([
                    'classes' => $classes
                ]);
            }

        }
        return view('general.class_schedule_v2_create', compact('classes'));
    }
    public function classScheduleStoreV2(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'class_code' => 'required|string',
        ]);

        $classInfo = DB::table('v_class_current')
            ->where('class_code', $request->class_code)
            ->first();

        if (!$classInfo) {
            // return response()->json(['status' => "false", 'message' => 'រកមិនឃើញថ្នាក់នេះទេ']);
             $classInfo = DB::table('classes')
                ->where('code', $request->class_code)
                ->first();
            $record = new GeneralClassSchedule();
            $record->class_code        = $request->class_code;
            $record->session_year_code = $classInfo->school_year_code ?? "";
            $record->years             = $classInfo->years ?? 1;
            $record->semester          = $classInfo->semester ?? 1;
            $record->sections_code     = $classInfo->sections_code;
            $record->skills_code       = $classInfo->skills_code;
            $record->qualification     = $classInfo->level;
            $record->department_code   = $classInfo->department_code;
            $record->start_date        = $request->start_date;

        
            $record->save(); 
        }
    
        // $existing = DB::table('class_schedule')
        // ->where('class_code', $request->class_code)
        // ->where('years', $classInfo->years)
        // ->where('semester', $classInfo->semester)
        // ->first();

       
        $class_schedule = DB::table('class_schedule')->latest('id')->first();
        return response()->json([
            'class_schedule' => $class_schedule->id,
            'success' => true,  
            'message' => 'បានរក្សាទិន្នន័យដោយជោគជ័យ',
        ]);
    }
    public function getClassData(Request $request)
    {
        $classCode = $request->class_code;

        if (!$classCode) {
            return response()->json(['success' => false, 'message' => 'មិនមានថ្នាក់នេះទេ']);
        }

        $classInfo = DB::table('class_schedule')
            ->where('class_code', $classCode)
            ->orderBy('id', 'desc')
            ->first();

        if (!$classInfo) {
            return response()->json(['success' => false, 'message' => 'ថ្នាក់នេះមិនមាន!']);
        }

        $subjects = DB::table('subjects')
            ->where('year_type', $classInfo->years)
            ->pluck('name','code');

        $sessions = DB::table('session')
            ->where('section_code', $classInfo->sections_code)
            ->select('name', 'start_time', 'end_time')
            ->get();

        $teachers = DB::table('teachers')
            ->select('code', 'name_2')
            ->get();

        $allDays = DB::table('date_name')
            ->orderBy('index', 'asc')
            ->pluck('name_2','code')
            ->toArray();

        $sectionCode = $classInfo->sections_code;
            if ($sectionCode === 'M') {
                $days = array_slice($allDays, 0, 6);
            } elseif ($sectionCode === 'N') {
                $days = array_slice($allDays, 0, 6);
            } elseif ($sectionCode === 'A') {
                $days = array_slice($allDays, 0, 6);
            } else {
                $days = [];
            }

        return response()->json([
            'classInfo' => $classInfo,
            'class_schedule_id' => $classInfo->id,
            'success' => true,
            'subjects' => $subjects,
            'teachers' => $teachers,
            'sessions' => $sessions,
            'days' => $days,
        ]);
    }
    public function storeAssignClassSchedule(Request $request)
    {

        $request->validate([
            'class_code' => 'required|string',
            'teachers_code' => 'required|string',
            'subjects_code' => 'required|string',
            'date_name' => 'required|string',
            'time_start' => 'required',
            'time_end' => 'required',
            'room' => 'required|string',
            'sessions_type' => 'required|integer',
            'class_schedule_id' => 'required|integer',
            'years' => 'required|integer',
            'semester' => 'required|integer',
        ]);

        try {

            $counter_add = DB::table('assing_classes')
                ->where('class_code', $request->class_code)
                ->where('teachers_code', $request->teachers_code)
                ->where('subjects_code', $request->subjects_code)
                ->count();

            if ($counter_add >= 2) {
                return response()->json([
                    'success' => false,
                    'conuter' => true,
                    'message' => 'អ្នកមិនអាចបន្ថែមមុខវិជ្ជានេះលើសពី 2 ដងទេ!'
                ]);
            }

            $conflict_teacher = DB::table('assing_classes')
                ->where('subjects_code',$request->subjects_code)
                ->where('sessions_type',3)
                ->first();

            if($conflict_teacher){
                $subject = DB::table('subjects')
                    ->where('code',$conflict_teacher->subjects_code)
                    ->value('name_2') ?? $subject_code;

                return response()->json([
                    'success' => false,
                    'confilct_teacher' => true,
                    'subject' => $subject,
                ]);
            }

            $conflict = DB::table('assing_classes')
                ->where('class_code', $request->class_code)
                ->where('date_name', $request->date_name)
                ->where('start_time', $request->time_start)
                ->where('end_time', $request->time_end)
                ->first();
            if ($conflict) {
                $dayName = DB::table('date_name')
                    ->where('code', $conflict->date_name)
                    ->value('name_2') ?? $conflict->date_name;

                return response()->json([
                    'success' => false,
                    'duplicate' => true,
                    'message' => 'មិនអាចបញ្ចូលម៉ោងដូចគ្នាបានទេ!',
                    'conflict_day' => $dayName,
                    'conflict_start' => $conflict->start_time,
                    'conflict_end' => $conflict->end_time
                ]);
            }

            $assing = AssingClasses::latest('id')->first();

            if ($assing) {
                $assing_no = $assing->assing_no + 10;
            } else {
                $assing_no = 10;
            }
            
            DB::table('assing_classes')->insert([
                'class_code' => $request->class_code,
                'teachers_code' => $request->teachers_code,
                'subjects_code' => $request->subjects_code,
                'date_name' => $request->date_name,
                'start_time' => $request->time_start,
                'end_time' => $request->time_end,
                'room' => $request->room,
                'sessions_type' => $request->sessions_type,
                'class_schedule_id' => $request->class_schedule_id,
                'years' => $request->years,
                'session_year_code' => $request->session_year_code,
                'sections_code' => $request->sections_code,
                'department_code' => $request->department_code,
                'skills_code' => $request->skills_code,
                'qualification' => $request->qualification,
                'semester' => $request->semester,
                'status' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'assing_no' => $assing_no,
            ]);

            $records = DB::table('assing_classes')
                ->where('class_schedule_id', $request->class_schedule_id)
                ->select('id', 'teachers_code', 'subjects_code', 'date_name', 'start_time', 'end_time', 'room')
                ->get();
                
            $day = DB::table('date_name')
                ->where('code', $request->date_name)
                ->orderBy('index', 'asc')
                ->pluck('name_2', 'code')
                ->toArray();

            $days = array_values($day);

            $sessionsRaw = DB::table('session')
                ->where('section_code', $request->sections_code)
                ->select('name', 'start_time', 'end_time')
                ->get();
            $recordsGrouped = $records->groupBy('date_name');   

            return response()->json([
                'success' => true,
                'message' => 'បានរក្សាទិន្នន័យដោយជោគជ័យ',
                'records' => $records,
                'days' => $days,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'មានបញ្ហា: ' . $e->getMessage(),
            ]);
        }
    }
    public function deleteAssignClassSchedule($id)
    {
        try {
            $deleted = DB::table('assing_classes')->where('id', $id)->delete();

            if ($deleted) {
                return response()->json([
                    'success' => true,
                    'message' => 'បានលុបទិន្នន័យដោយជោគជ័យ'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'មិនអាចលុបបានទេ' 
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'មានបញ្ហាផ្ទៃក្នុង: ' . $e->getMessage(),
            ]);
        }
    }
    public function editAssignClassSchedule($id)
    {
        try {

            $record = DB::table('assing_classes as ac')
                ->where('ac.id', $id)
                ->join('teachers', 'ac.teachers_code', '=', 'teachers.code')
                ->join('subjects', 'ac.subjects_code', '=', 'subjects.code')
                ->join('date_name', 'ac.date_name', '=', 'date_name.code')
                ->select(
                    'ac.id',
                    'ac.class_code',
                    'ac.teachers_code',
                    'teachers.name_2 as teacher_name',
                    'ac.subjects_code',
                    'subjects.name as subject_name',
                    'ac.date_name',
                    'date_name.name_2 as date_display',
                    'ac.start_time',
                    'ac.end_time',
                    'ac.room',
                    'ac.sessions_type'
                )
                ->first();

            if (!$record) {
                return response()->json([
                    'success' => false,
                    'message' => 'មិនមានទិន្នន័យនេះទេ'
                ]);
            }

            // Get class information (example: you probably already have this model or table)
            $classInfo = DB::table('class_schedule')
                ->where('class_code', $record->class_code ?? null)
                ->first();

            if (!$classInfo) {
                return response()->json([
                    'success' => false,
                    'message' => 'មិនអាចរកឃើញព័ត៌មានថ្នាក់បានទេ'
                ]);
            }

            // Dropdown data for modal
            $subjects = DB::table('subjects')
                ->where('year_type', $classInfo->years)
                ->pluck('name', 'code');

            $sessions = DB::table('session')
                ->where('section_code', $classInfo->sections_code)
                ->select('name', 'start_time', 'end_time')
                ->get();

            $teachers = DB::table('teachers')
                ->select('code', 'name_2')
                ->get();

            $allDays = DB::table('date_name')
                ->orderBy('index', 'asc')
                ->pluck('name_2', 'code')
                ->toArray();

            // Filter days based on section
            $sectionCode = $classInfo->sections_code;
                if ($sectionCode === 'M') {
                    $days = array_slice($allDays, 0, 5);
                } elseif ($sectionCode === 'N') {
                    $days = array_slice($allDays, 0, 6);
                } elseif ($sectionCode === 'A') {
                    $days = array_slice($allDays, 0, 5);
                } else {
                    $days = [];
                }   

            return response()->json([
                'success'  => true,
                'record'   => $record,
                'subjects' => $subjects,
                'teachers' => $teachers,
                'sessions' => $sessions,
                'days'     => $days
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'មានបញ្ហាផ្ទៃក្នុង: ' . $e->getMessage(),
            ]);
        }
    }
    public function updateAssignClassSchedule(Request $request, $id)
    {
            try {
                
                $conflict = DB::table('assing_classes')
                    ->where('class_code', $request->class_code)
                    ->where('date_name', $request->date_name)
                    ->where('start_time', $request->start_time)
                    ->where('end_time', $request->end_time)
                    ->first();

                if ($conflict) {
                    $dayName = DB::table('date_name')
                        ->where('code', $conflict->date_name)
                        ->value('name_2') ?? $conflict->date_name;

                    return response()->json([
                        'success' => false,
                        'duplicate' => true,
                        'message' => 'មិនអាចបញ្ចូលម៉ោងដូចគ្នាបានទេ!',
                        'conflict_day' => $dayName,
                        'conflict_start' => $conflict->start_time,
                        'conflict_end' => $conflict->end_time
                    ]);
                }

                $updated = DB::table('assing_classes')->where('id', $id)->update([
                    'class_code' => $request->class_code,
                    'teachers_code' => $request->teachers_code,
                    'subjects_code' => $request->subjects_code,
                    'date_name' => $request->date_name,
                    'start_time' => $request->start_time,
                    'end_time' => $request->end_time,
                    'room' => $request->room,
                    'sessions_type' => $request->sessions_type,
                    'updated_at' => now(),
                ]);

                if ($updated) {
                    return response()->json([
                        'success' => true,
                        'message' => 'បានកែប្រែទិន្នន័យដោយជោគជ័យ'
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'មិនមានការផ្លាស់ប្តូរទិន្នន័យ'
                    ]);
                }

            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'មានបញ្ហាផ្ទៃក្នុង: ' . $e->getMessage(),
                ]);
            }
    }
    public function classSchedulePrint($id)
    {
        $headers = DB::table('class_schedule as class_schedule')
        ->select(
                'class_schedule.*',
                'sections.name_2 as section_name',
                'department.name_2 as department_name',
                'skills.name_2 as skill_name'
            )
            ->join('sections', 'class_schedule.sections_code', '=', 'sections.code')
            ->join('department', 'class_schedule.department_code', '=', 'department.code')
            ->join('skills', 'class_schedule.skills_code', '=', 'skills.code')
            ->where('class_schedule.id', $id)
            ->first();
        // dd( $headers);

        $records = DB::table('assing_classes')->where('class_schedule_id', $id)->get();
        $days = [];
        $sessions = [];

        if ($records->isNotEmpty()) {
            $days = [];
            $sessions = [];
            $dayCodes = $records->pluck('date_name')->unique()->toArray();
            $days = DB::table('date_name')
                ->whereIn('code', $dayCodes)
                ->orderBy('index', 'asc')
                ->pluck('name_2', 'code')
                ->toArray();
        
            $sectionCode = $records->first()->sections_code;
            $sessionsRaw = DB::table('session')
                ->where('section_code', $sectionCode)
                ->select('name', 'start_time', 'end_time')
                ->get();

            $sessions = [];
                foreach ($records as $rec) {
                    $day = $rec->date_name;
                    $sessionKey = $rec->start_time . '-' . $rec->end_time;
                    
                    $teacher = DB::table('teachers')
                        ->where('code', $rec->teachers_code)
                        ->select('name_2', 'gender')
                        ->first();

                    $sessions[$day][$sessionKey] = [
                        'id' => $rec->id,
                        'teacher_name' => $teacher->name_2 ?? '',
                        'teacher_gender' => $teacher->gender ?? '',
                        'subject_name' => DB::table('subjects')
                            ->where('code', $rec->subjects_code)
                            ->value('name_2'),
                        'room' => $rec->room,
                    ];
                }
        }

        return view('general.class_schedule_v2_sub_list',compact('records', 'days', 'sessions','headers'));
    }
}
