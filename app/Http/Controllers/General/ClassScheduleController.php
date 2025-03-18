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
    public function index()
    {
        $page = $this->page;
        $records = GeneralClassSchedule::orderBy('session_year_code', 'asc')->paginate(20);
        // dd($records);
        if (!Auth::check()) {
            return redirect("login")->withSuccess('Opps! You do not have access');
        }
        return view('general.class_schedule', compact('records', 'page'));
    }
    public function transaction(request $request)
    {
        $data = $request->all();
        $type = $data['type'];
        $page = $this->page;
        $page_url = $this->page;
        $records = null;
        $record_sub_lines = AssingClasses::where('class_code', $data['type'])->get();
        $classs = Classes::orderBy('code', 'desc')->get();
        $sections = DB::table('sections')->get();
        $department = Department::get();
        $school_years = DB::table('session_year')->orderBy('code', 'desc')->get();
        $skills = DB::table('skills')->get();
        $study_years = StudyYears::get();
        $teachers = Teachers::orderBy('code', 'asc')->get();
        $subjects = Subjects::orderBy('code', 'asc')->get();
        $date_name = DB::table('date_name')->orderBy('index', 'asc')->get();
        $days = $date_name->pluck('name')->toArray();
        $qualification = DB::table('qualification')->get();

        try {
            $params = ['records', 'type', 'page', 'sections', 'department', 'school_years', 'skills', 'classs', 'study_years', 'teachers', 'subjects', 'record_sub_lines', 'date_name', 'days', 'qualification'];
            if ($type == 'cr') return view('general.class_schedule_card', compact($params));
            if (isset($_GET['code'])) {
                $records = GeneralClassSchedule::where('id', $this->services->Decr_string($_GET['code']))->first();
                $record_sub_lines = AssingClasses::where('class_code', $records->class_code)
                    ->where('semester', $records->semester)
                    ->where('years', $records->years)
                    ->where('qualification', $records->qualification)
                    ->where('sections_code', $records->sections_code)
                    ->where('skills_code', $records->skills_code)
                    ->where('department_code', $records->department_code)
                    ->get();
            }
            return view('general.class_schedule_card', compact($params));
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function delete(Request $request)
    {
        $code = $request->code;
        try {
            $records = GeneralClassSchedule::where('id', $code)->first();
            $assing_class = AssingClasses::where('class_schedule_id', $records->id)->Get();
            if(count($assing_class) > 0){
                return response()->json(['status' => 'warning', 'msg' => 'ទិន្ន័យមិនអាច លុប​បានទេ មានទិន្ន័យគ្រូ ចំនួន'. count($assing_class). 'សូចចុច Open']);
            }
            $records->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'msg' => 'ទិន្ន័យត្រូវបាន លុប​!']);
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function DeleteLine(Request $request)
    {
        $code = $request->code;
        try {
            
            DB::beginTransaction();
            $records = AssingClasses::where('id', $code)->first();
            $assing_class_line = AssingClassesStudentLine::where('assing_line_no', $records->assing_no)->Get();
            if(count($assing_class_line) > 0){
                return response()->json(['status' => 'warning', 'msg' => 'ទិន្ន័យមិនអាច លុប​បានទេ មានទិន្ន័យសិស្ស ចំនួន'. count($assing_class_line). 'នាក់']);
            }
            if (!$records->exists()) {
                return response()->json(['status' => 'warning', 'msg' => 'Record not found!']);
            }
            $records->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'msg' => 'ទិន្ន័យត្រូវបាន លុប​!']);
        } catch (\Exception $ex) {
            DB::rollback();
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function update(Request $request)
    {
        $input = $request->all();
        $code = $input['type'];
        $record = GeneralClassSchedule::where('id', $code)->first();
        if (!$record) return response()->json(['status' => 'error', 'msg' => "មិនអាចកែប្រ លេខកូដ!"]);
        try {
            $records = GeneralClassSchedule::where('id', $code)->first();
            if ($records) {
                $records->start_date = $request->start_date;
                $records->sections_code = $request->sections_code;
                $records->skills_code = $request->skills_code;
                $records->department_code = $request->department_code;
                $records->session_year_code = $request->school_year_code;
                $records->qualification = $request->level;
                $records->semester = $request->semester;
                $records->class_code = $request->class_code;
                $records->years = $request->years;
                $records->update();
            }
            return response()->json(['status' => 'success', 'msg' => 'បច្ចុប្បន្នភាព ទិន្នន័យជោគជ័យ!', '$records' => $records]);
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function store(request $request)
    {
        $input = $request->all();
        $requiredFields = [
            'start_date' => 'ចាប់ផ្តើមអនុវត្ត ត្រូវបំពេញ!',
            'class_code' => 'ថា្នក់/ក្រុម​ ត្រូវបំពេញ!',
            'sections_code' => 'វេន ត្រូវបំពេញ!',
            'skills_code' => 'ជំនាញ ត្រូវបំពេញ!',
            'department_code' => 'ដេប៉ាតឺម៉ង់ ត្រូវបំពេញ!',
            'school_year_code' => 'ឆ្នាំសិក្សា ត្រូវបំពេញ!',
            'level' => 'Level is ត្រូវបំពេញ!',
            'semester' => 'Semester is ត្រូវបំពេញ!',
            'years' => 'ត្រូវបំពេញ បរិញាប័ត្រ ឆ្នាំ !'
        ];
        foreach ($requiredFields as $field => $message) {
            if (empty($input[$field])) {
                return response()->json(['status' => 'error', 'msg' => $message]);
            }
        }
        try {
            $records = new GeneralClassSchedule();
            $records->start_date = $request->start_date;
            $records->sections_code = $request->sections_code;
            $records->skills_code = $request->skills_code;
            $records->department_code = $request->department_code;
            $records->session_year_code = $request->school_year_code;
            $records->qualification = $request->level;
            $records->semester = $request->semester;
            $records->class_code = $request->class_code;
            $records->years = $request->years;
            $records->save();

            $record = GeneralClassSchedule::latest('id')->first();
            if (isset($record->id)) {
                $encryptedCode = \App\Service\service::Encr_string($record->id);
                $url = "/class-schedule/transaction?type=ed&code=" . $encryptedCode;
            }
            return response()->json(['store' => 'yes', 'url' => $url, 'msg' => 'Records Add Succesfully !!']);
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function printLine(Request $request)
    {
        $data = $request->all();
        $is_print = "yes";
        $date_name = DB::table('date_name')->orderBy('index', 'asc')->get();
        $days = $date_name->pluck('name')->toArray();
        try {
            $records = GeneralClassSchedule::where('id', $this->services->Decr_string($_GET['code']))->first();
            $record_sub_lines = AssingClasses::where('class_code', $records->class_code)
                ->where('semester', $records->semester)
                ->where('years', $records->years)
                ->where('qualification', $records->qualification)
                ->where('sections_code', $records->sections_code)
                ->where('skills_code', $records->skills_code)
                ->where('department_code', $records->department_code)
                ->get();
            return view('general.class_schedule_sub_lists', compact('records', 'record_sub_lines', 'is_print', 'date_name', 'days'));
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function SaveSchedule(Request $request)
    {
        $data = $request->all();

        $id = $this->services->Decr_string($data['code']);
        $header = GeneralClassSchedule::where('id', $id)->first();
        $requiredFields = [
            'teachers_code' => 'សាស្រ្តាចារ្យ​ ត្រូវបំពេញ!',
            'subjects_code' => 'មុខវិជ្ជា​ ត្រូវបំពេញ!',
            'date_name' => 'ថ្ងៃបង្រៀន ត្រូវបំពេញ!',
        ];

        foreach ($requiredFields as $field => $message) {
            if (empty($data[$field])) {
                return response()->json(['status' => 'error', 'msg' => $message]);
            }
        }

        $assing = AssingClasses::latest('id')->first();

        if ($assing) {
            $assing_no = $assing->assing_no + 10;
        } else {
            $assing_no = 10;
        }
        try {
            if (isset($data['dataId']) && $data['dataId']) {
                $records = AssingClasses::where('class_schedule_id', $id)->where('id', $data['dataId'])->first();

                $assing_class_line = AssingClassesStudentLine::where('assing_line_no', $records->assing_no)->Get();
                if(count($assing_class_line) > 0){
                    return response()->json(['status' => 'error', 'msg' => 'ទិន្ន័យមិនអាច ក្រែប្រែ​បានទេ មានទិន្ន័យសិស្ស ចំនួន'. count($assing_class_line). 'នាក់']);
                }

                $records->room = $request->room;
                $records->teachers_code = $request->teachers_code;
                $records->date_name = $request->date_name;
                $records->start_time = $request->start_time;
                $records->end_time = $request->end_time;
                $records->subjects_code = $request->subjects_code;
                $records->update();

                $is_print = "No";
                $date_name = DB::table('date_name')->orderBy('index', 'asc')->get();
                $days = $date_name->pluck('name')->toArray();
                $records = GeneralClassSchedule::where('id', $id)->first();
                $record_sub_lines = AssingClasses::where('class_code', $records->class_code)
                    ->where('semester', $records->semester)
                    ->where('years', $records->years)
                    ->where('qualification', $records->qualification)
                    ->where('sections_code', $records->sections_code)
                    ->where('skills_code', $records->skills_code)
                    ->where('department_code', $records->department_code)
                    ->get();

                if ($is_print == 'Yes') {
                    $view = view('general.class_schedule_sub_lists', compact('records', 'days', 'record_sub_lines', 'is_print'))->render();
                    return response()->json(['status' => 'success', 'msg' => 'Data Udpate successfully', 'view' => $view]);
                } else {
                    $view = view('general.class_schedule_sub_lists', compact('records', 'days', 'record_sub_lines'))->render();
                    return response()->json(['status' => 'success', 'msg' => 'Data Udpate successfully', 'view' => $view]);
                }
            } else {
                $records = new AssingClasses();
                $records->class_schedule_id = $header->id;
                $records->assing_no = $assing_no;
                $records->teachers_code = $request->teachers_code;
                $records->class_code = $header->class_code;
                $records->sections_code = $header->sections_code;
                $records->skills_code = $header->skills_code;
                $records->department_code = $header->department_code;
                $records->session_year_code = $header->session_year_code;
                $records->subjects_code = $request->subjects_code;
                $records->status = $request->status;
                $records->semester = $header->semester;
                $records->qualification = $header->qualification;
                $records->years = $header->years;

                $records->room = $request->room;
                $records->date_name = $request->date_name;
                $records->start_time = $request->start_time;
                $records->end_time = $request->end_time;
                $records->save();

                $is_print = "No";
                $date_name = DB::table('date_name')->orderBy('index', 'asc')->get();
                $days = $date_name->pluck('name')->toArray();
                $records = GeneralClassSchedule::where('id', $id)->first();
                $record_sub_lines = AssingClasses::where('class_code', $records->class_code)
                    ->where('semester', $records->semester)
                    ->where('years', $records->years)
                    ->where('qualification', $records->qualification)
                    ->where('sections_code', $records->sections_code)
                    ->where('skills_code', $records->skills_code)
                    ->where('department_code', $records->department_code)
                    ->get();

                if ($is_print == 'Yes') {
                    $view = view('general.class_schedule_sub_lists', compact('records', 'days', 'record_sub_lines', 'is_print'))->render();
                    return response()->json(['status' => 'success', 'msg' => 'Data add successfully', 'view' => $view]);
                } else {
                    $view = view('general.class_schedule_sub_lists', compact('records', 'days', 'record_sub_lines'))->render();
                    return response()->json(['status' => 'success', 'msg' => 'Data add successfully', 'view' => $view]);
                }
            }
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }

    public function EditTeacherSchedule(Request $request)
    {
        $data = $request->all();
        try {
            $subjects = Subjects::orderBy('code')->get();
            $teachers = Teachers::orderBy('code')->get();
            $records = AssingClasses::with(['subject', 'teacher'])->where('id',  $data['id'])->first();
            return response()->json(['status' => 'success', 'records' => $records, 'subjects' => $subjects, 'teachers' => $teachers]);
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }

    public function Search(Request $request, $page)
    {
        dd("helo");
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
                if ($page == 'student') {
                    $menus = DB::table('student')->where('name', 'like', $search_value . "%")
                        ->orWhere('code', 'like', $search_value . "%")
                        ->orWhere('name_2', 'like', $search_value . "%")
                        ->where('class_code', '<>', null)->get();
                    $blade_file_record = 'student.student_list';
                } else if ($page == 'department') {
                    $menus = DB::table('department')->where('department_name', 'like', $search_value . "%")
                        ->where('id', '<>', null)->get();
                    $blade_file_record = 'department.department_list';
                }

                if (count($menus) > 0) {
                    foreach ($menus as $menu) {
                        if ($strings[0] == 'OPEN' && count($strings) > 2) {
                            $menu->code = $menu->code . ' ' . $strings[count($strings) - 1];
                        }
                        $menu->url = $menu->url . ($strings[0] == 'NEW' ? "type=cr" : "type=ed&code=" . $this->service->Encr_string($strings[count($strings) - 1]));
                    }
                }
            } else {
                for ($i = 0; $i < count($strings); $i++) {
                    $search_value .= $strings[$i] . " ";
                }
                $search_value = rtrim($search_value, " ");
                if ($page == 'student') {
                    $menus = DB::table('student')->where('name', 'like', $search_value . "%")
                        ->orWhere('code', 'like', $search_value . "%")
                        ->orWhere('name_2', 'like', $search_value . "%")
                        ->where('class_code', '<>', null)->paginate(1000);
                    $blade_file_record = 'student.student_list';
                } else if ($page == 'department') {
                    $menus = DB::table('department')->where('department_name', 'like', $search_value . "%")
                        ->where('id', '<>', null)->paginate(1000);
                    $blade_file_record = 'department.department_list';
                }
            }

            if (count($menus) > 0) {
                $records = $menus;
            } else {
                if ($page == 'student') {
                    $records = Student::where('department_code', $user->childs)->paginate(10);
                } else if ($page == 'department') {
                    $records = Department::paginate(15);
                }
            }
            $view = view($blade_file_record, compact('records'))->render();
            return response()->json(['status' => 'success', 'view' => $view]);
        }
        return 'none';
    }

    public function DownlaodexcelLine(Request $request)
    {
        try {
            $filter = $request->all();

            dd($filter);
            $header = null;
            $department = $filter['department_code'];
            $department = Department::where('code', $department)->first();
            if ($department){
                $department = $department->name_2;
            }
            $skills = $filter['skills_code'];
            $skills = Skills::where('code', $skills)->first();
            if ($skills){
                $skills = $skills->name_2;
            }
            $sections = $filter['sections_code'];
            $sections = Sections::where('code', $sections)->first();
            if ($sections){
                $sections = $sections->name_2;
            }
            $qualification = $filter['qualification'];
            $qualification = Qualifications::where('code', $qualification)->first();
            if ($qualification) {
                $qualification = $qualification->name_2;
            }

            $extract_query = $this->services->extractQuery($filter);
           
            // Use get() instead of paginate() for exporting
            $records = Student::whereRaw($extract_query)
            ->where('study_type', 'new student')
            ->orderBy('class_code')
            ->orderBy('department_code')
            ->orderByRaw("name_2 COLLATE utf8mb4_general_ci")
            ->get()
            ->map(function ($record) {
                $record->skills = DB::table('skills')->where('code', $record->skills_code)->value('name_2');
                $record->classes = DB::table('classes')->where('code', $record->class_code)->value('name');
                $record->section = DB::table('sections')->where('code', $record->sections_code)->value('name_2');
                $record->gender = $record->gender;
                $record->department = DB::table('department')->where('code', $record->department_code)->value('name_2');
                $record->khmerDate = service::DateFormartKhmer($record->date_of_birth);
                $record->year_student = service::calculateDateDifference($record->posting_date);
                $record->picture = Picture::where('code', $record->code)
                    ->where('type', 'student')
                    ->value('picture_ori');
                return $record;
            });


            $blade_download = "general.student_register_lists_excel";

            // Create an instance of ExportData and pass the necessary parameters
            return Excel::download(new ExportData($records, $blade_download, $department, $sections, $skills, $qualification, $header), 'registration.xlsx');

            return response()->json(['status' =>'success','view' =>$view]);
        } catch (\Exception $ex){
            $this->services->telegram($ex->getMessage(),'list of student',$ex->getLine());
            return response()->json(['status' => 'warning' , 'msg' => $ex->getMessage()]);
        }
    }
}
