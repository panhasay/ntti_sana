<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\General\AssingClasses;
use App\Models\General\Classes;
use App\Models\General\DividedNewClasses;
use App\Models\General\Picture;
use App\Models\General\Qualifications;
use App\Models\General\Sections;
use App\Models\General\Skills;
use App\Models\General\StudentRegistration;
use App\Models\General\StudyYears;
use App\Models\General\Subjects;
use App\Models\General\Teachers;
use App\Models\Student\Student;
use App\Models\SystemSetup\Department;
use App\Service\service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Exports\ExportData;
use Maatwebsite\Excel\Facades\Excel;


class DividedNewClassesController extends Controller
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
        $this->page = "class-new";
        $this->prefix = "class-new";
        $this->arrayJoin = ['10001', '10007', '10008'];
        $this->table_id = "10005";
    }
    public function index(){
        $page = $this->page;
        $sections = DB::table('sections')->get();
        $department = Department::get();
        $skills = DB::table('skills')->get();
        $qualifications = Qualifications::get();
        
        $records = Classes::leftJoin('student', 'student.class_code', '=', 'classes.code')
            ->select('classes.code',  'classes.level', 'classes.department_code', 'classes.school_year_code', 'classes.name', 'classes.skills_code', 'classes.sections_code', DB::raw('COUNT(student.name) as totals_student'))
            ->groupBy('classes.code',  'classes.level', 'classes.department_code', 'classes.school_year_code', 'classes.name', 'classes.skills_code', 'classes.sections_code') 
            ->orderBy('totals_student', 'desc')
            ->orderBy('classes.department_code', 'desc')
            ->paginate(20);
        $total_records = Student::select(
            DB::raw('COUNT(name) AS total_count'),  
        )->where('study_type', 'new student')
         ->get();
        if(!Auth::check()){
            return redirect("login")->withSuccess('Opps! You do not have access');
        }  
        return view('general.divided_new_classes', compact('records','page', 'department', 'sections', 'skills', 'qualifications', 'total_records'));	
    }
    public function transaction(request $request)
    {
        $data = $request->all();
        $type = $data['type'];
        $page = $this->page;
        $page_url = $this->page;
        $records = null;
        $records_student = "";
        $record_sub_lines = AssingClasses::where('class_code', $data['type'])->get();
        $classs = Classes::orderBy('code', 'desc')->get();
        $sections = DB::table('sections')->get();
        $department = Department::get();
        $school_years = DB::table('session_year')->orderBy('code', 'desc')->get();   
        $skills = DB::table('skills')->get();
        $study_years = StudyYears::get();
        $teachers = Teachers::orderBy('code', 'asc')->get();
        $subjects = Subjects::orderBy('code', 'asc')->get(); 
        $qualifications = Qualifications::orderBy('code', 'desc')->get();
        try {
            $params = ['records', 'type', 'page', 'sections', 'department', 'school_years', 'skills', 'classs', 'study_years', 'teachers', 'subjects', 'record_sub_lines', 'qualifications', 'records_student'];
            if ($type == 'cr') return view('general.divided_new_classes_card', compact($params));
            if (isset($_GET['code'])) {
                $records = Classes::where('code', $this->services->Decr_string($_GET['code']))->first();
                $record_sub_lines = Student::where('class_code', $records->code)
                                ->where('qualification', $records->level)
                                ->where('sections_code', $records->sections_code)
                                ->where('skills_code', $records->skills_code)
                                ->where('department_code', $records->department_code)
                                ->get();  
            }
        return view('general.divided_new_classes_card', compact($params));
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function GEteStudentRegister(request $request)
    {
        $data = $request->all();
        try {
            $class = Classes::where('code', $this->services->Decr_string($_GET['code']))->first();
            if (!$class) {
                return response()->json(['status' => 'error', 'msg' => 'Class not found'], 404);
            }
            $records_student = StudentRegistration::where('skills_code', $class->skills_code)
                ->where('qualification', $class->level)
                ->where('sections_code', $class->sections_code)
                ->where('department_code', $class->department_code)
                ->get();   // Use get() to fetch the records

                $class_code = $class->code;

            // / Prepare additional data for each student
            $students = $records_student->map(function ($record) use ($class) {
                return [
                    'code' => $record->code,
                    'name' => $record->name,
                    'name_2' => $record->name_2,
                    'gender' => $record->gender,
                    'date_of_birth' => service::DateFormartKhmer($record->date_of_birth),
                    'phone_student' => $record->phone_student,
                    'skills' => DB::table('skills')->where('code', $record->skills_code)->value('name_2'),
                    'qualification' => $record->qualification,
                    'section' => DB::table('sections')->where('code', $record->sections_code)->value('name_2'),
                    'department' => DB::table('department')->where('code', $record->department_code)->value('name_2'),
                    'session_year_code' => $record->session_year_code 
                        ? str_replace('_', '-', $record->session_year_code) 
                        : '',
                    'posting_date' => $record->posting_date,
                    'year_student' =>service::calculateDateDifference($record->posting_date),
                    'picture' => Picture::where('code', $record->code)
                        ->where('type', 'student')
                        ->value('picture_ori'),
                    'check_student_class' => DB::table('student')->where('class_code', $class->code)->value('code'),
                ];
            });

            return view('system.model_divided_new_class', compact('students', 'class_code'))->render();
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function AddStudentRegister(request $request)
    {
        $data = $request->all();

        $check =  Student::where('code', $data['code'])->first();
        if($check){
            return response()->json(['msg' => 'ទិន្ន័យមានរួចហើយ']);
        }
        try {
            $records_student = StudentRegistration::where('code', $data['code'])->first();
            $records = new Student();
            if(!$records_student){
                return response()->json(['msg' => 'មិនមាន ទិន្ន័យ !']);
            }
            $records = new Student();
            $records->code = $records_student->code;
            $records->class_code = $data['class_code'];
            $records->name_2 = $records_student->name_2;
            $records->name = $records_student->name; 
            $records->date_of_birth = $records_student->date_of_birth; 
            $records->student_address = $records_student->student_address;
            $records->current_address = $records_student->current_address;
            $records->occupation = $records_student->occupation; 
            $records->phone_student = $records_student->phone_student; 
            $records->guardian_name = $records_student->guardian_name; 
            $records->guardian_phone = $records_student->guardian_phone; 
            $records->father_name = $records_student->father_name; 
            $records->father_occupation = $records_student->father_occupation; 
            $records->mother_name = $records_student->mother_name; 
            $records->mother_occupation = $records_student->mother_occupation; 
            $records->education_Level = $records_student->education_Level; 
            $records->skills_code = $records_student->skills_code; 
            $records->sections_code = $records_student->sections_code; 
            $records->apply_year = $records_student->apply_year; 
            $records->qualification = $records_student->qualification; 
            $records->status = $records_student->status; 
            $records->register_date = $records_student->register_date;
            $records->study_type = "new student";
            $records->gender = $records_student->gender;
            $records->session_year_code = $records_student->session_year_code;
            $records->semester = $records_student->semester;
            $records->department_code = $records_student->department_code;
            $records->user_id = Auth::user()->id;
            $records->bakdop_results = $records_student->bakdop_results;
            $records->year_final = $records_student->year_final;
            $records->bakdop_index = $records_student->bakdop_index;
            $records->bakdop_province = $records_student->bakdop_province;
            $records->bakdop_type = $records_student->bakdop_type;
            $records->scholarship = $records_student->scholarship;
            $records->scholarship_type = $records_student->scholarship_type;
            $records->submit_your_application = $records_student->submit_your_application;
            $records->educational_institutions = $records_student->educational_institutions;
            $records->save(); 

            $code_last = Student::latest('code')->first();
            $code_transetion = \App\Service\service::Encr_string($code_last->code);

            return response()->json(['code_transetion'=> $code_transetion,'store' => 'yes', 'msg' => 'លោកអ្នកបាន ចុះឈ្មោះជោជ័យ']);
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function DeleteStudentRegisterDeleteline(Request $request)
    {
        $code = $request->code;
        try {
            $records = Student::where('code',$code);
            $records->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'msg' => 'ទិន្ន័យត្រូវបាន លុប​!']);
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }


    public function ClassNewDownloadExcel(Request $request)
    {
        try {
            $filter = $request->all();
            $extract_query = $this->services->extractQuery($filter);
            $header = Classes::where('code', $this->services->Decr_string($_GET['code']))->first();
            $code_class = $this->services->Decr_string($_GET['code']);

            $excel_name = $code_class . '_class.xlsx';
            // Fetch student records with relationships to avoid N+1 queries
            $records = Student::where('class_code', $this->services->Decr_string($_GET['code']))
                ->where('study_type', 'new student')
                ->get()
                ->map(function ($record) {
                    $record->skills = DB::table('skills')->where('code', $record->skills_code)->value('name_2');
                    $record->classes = DB::table('classes')->where('code', $record->class_code)->value('name');
                    $record->section = DB::table('sections')->where('code', $record->sections_code)->value('name_2');
                    $record->gender = $record->gender;
                    $record->department = DB::table('department')->where('code', $record->department_code)->value('name_2');
                    $record->khmerDate = $this->services->DateFormartKhmer($record->date_of_birth);
                    $record->year_student = $this->services->calculateDateDifference($record->posting_date);
                    $record->picture = Picture::where('code', $record->code)
                        ->where('type', 'student')
                        ->value('picture_ori');
                    return $record;
                });
            
            // Optimize header-related queries
            $department = optional(Department::where('code', $header->department_code)->first())->name_2;
            $skills = optional(Skills::where('code', $header->skills_code)->first())->name_2;
            $sections = optional(Sections::where('code', $header->sections_code)->first())->name_2;
            $qualification = optional(Qualifications::where('code', $header->level)->first())->name_2;
            
            $blade_download = "general.divided_new_classes_card_excel";
            
            // Export data to Excel
            return Excel::download(new ExportData($records, $blade_download, $department, $sections, $skills, $qualification, $header), $excel_name);
            
        } catch (\Exception $ex){
            $this->services->telegram($ex->getMessage(),'list of student',$ex->getLine());
            return response()->json(['status' => 'warning' , 'msg' => $ex->getMessage()]);
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
    public function ClassNewPrintLine(Request $request)
    {
     
        $data = $request->all();
        $is_print = "yes";
        try {
            $records = Classes::where('code', $this->services->Decr_string($_GET['code']))->first();
            $record_sub_lines = Student::where('class_code', $records->class_code)
                                        ->where('semester', $records->semester)
                                        ->where('years', $records->years)
                                        ->where('qualification', $records->qualification)
                                        ->where('sections_code', $records->sections_code)
                                        ->where('skills_code', $records->skills_code)
                                        ->where('department_code', $records->department_code)
                                        ->get();

            return view('general.class_schedule_sub_lists', compact('records', 'record_sub_lines', 'is_print'));
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

        dd($header);

        $assing = AssingClasses::latest('id')->first();

        if($assing){
            $assing_no = $assing->assing_no + 10;
        }else{
            $assing_no = 10;
        }

        try {
            $records = new AssingClasses();
            $records->class_schedule_id = $header->id;
            $records->teachers_code = $request->teachers_code;
            $records->class_code = $request->class_code;
            $records->sections_code = $request->sections_code;
            $records->skills_code = $request->skills_code;
            $records->department_code = $request->department_code;
            $records->session_year_code = $request->session_year_code;
            $records->subjects_code = $request->subjects_code;
            $records->status = $request->status;
            $records->semester = $request->semester;
            $records->qualification = $request->qualification;

            dd($records);

            return view('student.student_print', compact('records', 'class_record'));
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
        return response()->json(['status' => 'success', 'records' => $records, 'subjects' => $subjects, 'teachers'=>$teachers]);
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }

    public function Search (Request $request,$page)
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
                if($page == 'student'){
                    $menus = DB::table('student')->where('name','like', $search_value . "%")
                                        ->orWhere('code', 'like', $search_value . "%")
                                        ->orWhere('name_2', 'like', $search_value . "%")
                                        ->where('class_code', '<>', null)->get();
                    $blade_file_record = 'student.student_list';
                }else if($page == 'department'){
                    $menus = DB::table('department')->where('department_name','like', $search_value . "%")
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
                    $blade_file_record = 'student.student_list';
                }else if($page == 'department'){
                    $menus = DB::table('department')->where('department_name','like', $search_value . "%")
                            ->where('id', '<>', null)->paginate(1000);
                    $blade_file_record = 'department.department_list';
                }
            }
           
            if (count($menus) > 0) {
                $records = $menus;
            }else{
                if($page == 'student'){
                    $records = Student::where('department_code',$user->childs)->paginate(10);
                }else if($page == 'department'){
                    $records = Department::paginate(15);
                }
            }
            $view = view($blade_file_record,compact('records'))->render();
            return response()->json(['status' =>'success','view' =>$view]);
        }
        return 'none';
    }
    
}

