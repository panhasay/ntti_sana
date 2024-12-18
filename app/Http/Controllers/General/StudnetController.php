<?php
/**
 * Created by Say Panha.
 * User: Panha
 * Date: 18/3/2024
 * Time: 3:22 PM
 */
namespace App\Http\Controllers\General;

use Hash;
use App\Http\Controllers\Controller;
use App\Models\Student\Student;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Service\service;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
// use Vtiful\Kernel\Excel;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportData;
use App\Exports\UsersExport;
use App\Imports\ImportExcell;
use App\Models\General\Classes;
use App\Models\General\Picture;
use App\Models\General\Skills;
use App\Models\General\StudentRegistration;
use Illuminate\Auth\Events\Validated;
use App\Models\General\StudyYears;
use App\Models\SystemSetup\Department;
use App\Models\General\Qualifications;
use App\Models\General\Sections;
use UserImport;

class StudnetController extends Controller
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
        $this->page = "Student";
        $this->prefix = "Student";
        $this->arrayJoin = ['10001', '10007', '10008'];
        $this->table_id = "10005";
    }
    public function index()
    {
        try {
            $user = Auth::user();

            if(isset($user->role) && $user->role == 'user_department'){
                $records = Student::where('department_code', $user->childs)
                ->orderBy('code', 'asc')
                ->paginate(10);
            }else if(isset($user->role) && $user->role == 'student'){
                return redirect("user-dont-have-permission")->withSuccess('Opps! You do not have access');
            }
            else{
                $records = Student::orderBy('code', 'asc')->paginate(15);
            }
            $class_record = DB::table('classes')->get();
            if (Auth::check()   ) {
                return view('general.student', compact('records', 'class_record'));
            } else {
                return redirect("login")->withSuccess('Opps! You do not have access');
            }
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function StudentRegistration(Request $request){
        $sql = "
            UPDATE student_registration AS reg
            INNER JOIN student AS stu ON stu.code = reg.code
            SET reg.class_code = stu.class_code
            WHERE reg.code = stu.code AND reg.department_code = stu.department_code
        ";
        DB::statement($sql);
        
        $user = Auth::user();
        $sections = DB::table('sections')->get();
        $department = Department::get();
        $skills = DB::table('skills')->get();
        $qualifications = Qualifications::get();
       

        if($user->role == "teachers"){
            $total_student_have_class = Student::select(
                DB::raw('COUNT(name) AS total_count'),  
            )->where('study_type', 'new student')
            ->where('department_code', $user->department_code)
            ->whereNotNull('class_code')
            ->get();

            $total_records = StudentRegistration::select(
                DB::raw('COUNT(name) AS total_count'),  
            )->where('study_type', 'new student')
             ->where('department_code', $user->department_code)
             ->get();
            $records = StudentRegistration::with(['session_year'])
            ->where('study_type', 'new student')
            ->where('department_code', $user->department_code)
            ->orderBy('code', 'desc')->paginate(15);
        }else{

            $total_records = StudentRegistration::select(
                DB::raw('COUNT(name) AS total_count'),  
            )->where('study_type', 'new student')
             ->get();

            $total_student_have_class = Student::select(
                DB::raw('COUNT(name) AS total_count'),  
            )->where('study_type', 'new student')
            ->whereNotNull('class_code')
            ->get();

            // dd($total_student_have_class);  

            $records = StudentRegistration::with(['session_year'])->where('study_type', 'new student')->orderBy('code', 'desc')->paginate(15);
        }
        return view('general.student_register', compact('records', 'total_records', 'qualifications', 'skills', 'department', 'sections', 'sections', 'total_student_have_class'));
    }
    public function transaction(request $request)
    {
        $data = $request->all();
        $type = $data['type'];
        $page = ucwords(str_replace("_", " ", $this->page));
        $page_url = $this->page;
        $class_record = DB::table('classes')->get();
        $skills_records = DB::table('skills')->get();
        $sections = DB::table('sections')->get();
        $department = DB::table('department')->get();
        $currentDate = Carbon::now()->toDateString(); // Get the current date in the format 'YYYY-MM-DD'
        $records = null;
        $user_student = '';
        try {
            $params = ['records', 'class_record', 'type', 'skills_records', 'sections', 'department', 'user_student', 'currentDate'];
            if ($type == 'cr')
                return view('general.student_card', compact($params));

            if (isset($_GET['code'])) {
                $records = Student::where('code', $this->services->Decr_string($_GET['code']))->first();
                $string = $records->name;
                $data_string = str_replace(' ', '_', $string);
                $user_student = $data_string;
            }
            return view('general.student_card', compact($params));
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function StudentRegistrationTransaction(request $request)
    {
        $data = $request->all();
        $type = $data['type'];
        $page = ucwords(str_replace("_", " ", $this->page));
        $page_url = $this->page;
        $class_record = DB::table('classes')->get();
        $skills_records = DB::table('skills')->get();
        $sections = DB::table('sections')->get();
        $department = DB::table('department')->get();
        $currentDate = Carbon::now()->toDateString(); // Get the current date in the format 'YYYY-MM-DD'
        $records = null;
        $user_student = '';
        $skills = Skills::get();
        $school_years = DB::table('session_year')->orderBy('code', 'desc')->get();
        $study_years = StudyYears::get();
        try {
            $params = ['records', 'class_record', 'type', 'skills_records', 'sections', 'department', 'user_student', 'currentDate', 'skills', 'school_years', 'study_years'];
            if ($type == 'cr')
                return view('general.student_register_card', compact($params));

            if (isset($_GET['code'])) {
                $records = StudentRegistration::where('code', $this->services->Decr_string($_GET['code']))->first();
                $string = $records->name;
                $data_string = str_replace(' ', '_', $string);
                $user_student = $data_string;
            }
            return view('general.student_register_card', compact($params));
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function store(request $request)
    {
        $input = $request->all();
        $record = Student::where('code', $input['code'])->first();
        if ($record)
            return response()->json(['status' => 'error', 'msg' => 'អត្តលេខ មានរូចហើយ​!']);
        $records = new Student();
        if (!$input['code'] || !$input['name']) {
            return response()->json(['status' => 'error', 'msg' => 'Field request form server!']);
        }
        $status = ($input['status'] == 'no') ? 'no' : 'yes';
        try {
            $records->code = $request->code;
            $records->status = $status;
            $records->name = $request->name;
            $records->name_2 = $request->name_2;
            $records->date_of_birth = $request->date_of_birth;
            $records->class_code = $request->class_code;
            $records->phone_student = $request->phone_student;
            $records->skills_code = $request->skills_code;
            $records->email = $request->email;
            $records->gender = $request->gender;
            $records->student_address = $request->student_address;
            $records->father_name = $request->father_name;
            $records->father_phone = $request->father_phone;
            $records->father_occupation = $request->father_occupation;
            $records->mother_name = $request->mother_name;
            $records->mother_phone = $request->mother_phone;
            $records->mother_occupation = $request->mother_occupation;
            $records->guardian_name = $request->guardian_name;
            $records->guardian_phone = $request->guardian_phone;
            $records->guardian_occupation = $request->guardian_occupation;
            $records->guardian_address = $request->guardian_address;
            $records->study_type = $request->study_type;
            $records->department_code = $request->department_code;
            $records->sections_code = $request->sections_code;
            $records->posting_date = $request->posting_date;
            $records->save();
            return response()->json(['store' => 'yes', 'msg' => 'Records Add Succesfully !!']);
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function storeRegistration(request $request)
    {
        $input = $request->all();   
        $requiredFields = [
            'name' => 'សូមបំពេញ ខ្ញុំបាទ/នាងខ្ញុំឈ្មោះ',
            'name_2' => 'សូមបំពេញឈ្មោះ អក្សរឡាតាំង',
            'gender' => 'សូមបំពេញឈ្មោះ ភេទ',
            'date_of_birth' => 'សូមបំពេញ ថ្ងៃ ខែ ឆ្នាំកំណើត',
            'student_address' => 'សូមបំពេញ ទីកន្លែងកំណើត',
            'current_address' => 'សូមបំពេញ អាសយដ្ឋានបច្ចុប្បន្ន!',
            'phone_student' => 'សូមបំពេញ លេខទូរស័ព្ទ!',
            'father_name' => 'សូមបំពេញ​ ​ឈ្មោះឪពុក',
            'mother_name' => 'សូមបំពេញ​ ឈ្មោះម្ដាយ',
            'skills_code' => 'សូមបំពេញ​ ជំនាញ',
            'sections_code' => 'សូមបំពេញ​ វេន',
            'apply_year' => 'សូមបំពេញ​ សុំចូលរៀន',
            'qualification' => 'សូមបំពេញ​ កម្រិត',
            'session_year_code' => 'សូមបំពេញ​ ឆ្នាំសិក្សា',
        ];

        foreach ($requiredFields as $field => $message) {
            if (empty($input[$field])) {
                return response()->json(['status' => 'error', 'msg' => $message]);
            }
        }

        $lastRecord = StudentRegistration::latest('code')->first();
        $code =  $lastRecord->code;
        $record = StudentRegistration::where('name_2',$request->name_2)->first();

        if (isset($record->name_2) && $record->name_2 == $request->name_2){
            return response()->json(['status' => 'error', 'msg' => "ឈ្មោះ\"{$request->name_2}\"មានរួចហើយ​!"]);
        }
        $department_code = Skills::where('code',  $input['skills_code'])->first();
        if($department_code) {
            $department_code = $department_code->department_code;
        }
        $status = ($input['status'] == 'no') ? 'no' : 'yes';
        $phone_student = $this->services->convertKhmerToEnglishNumber($request->phone_student);
        $guardian_phone = $this->services->convertKhmerToEnglishNumber($request->guardian_phone);

        $date_of_birth = \Carbon\Carbon::parse($request->date_of_birth)->format('Y-m-d'); 
        try {
            $records = new StudentRegistration();
            $records->code = $lastRecord ? $lastRecord->code + 1 : 1;
            $records->name_2 = $request->name_2;
            $records->name = $request->name; 
            $records->date_of_birth = $date_of_birth; 
            $records->student_address = $request->student_address;
            $records->current_address = $request->current_address;
            $records->occupation = $request->occupation; 
            $records->phone_student = $phone_student; 
            $records->guardian_name = $request->guardian_name; 
            $records->guardian_phone = $guardian_phone; 
            $records->father_name = $request->father_name; 
            $records->father_occupation = $request->father_occupation; 
            $records->mother_name = $request->mother_name; 
            $records->mother_occupation = $request->mother_occupation; 
            $records->education_Level = $request->education_Level; 
            $records->skills_code = $request->skills_code; 
            $records->sections_code = $request->sections_code; 
            $records->apply_year = $request->apply_year; 
            $records->qualification = $request->qualification; 
            $records->status = $request->status; 
            $records->register_date = Carbon::now();
            $records->study_type = "new student";
            $records->gender = $request->gender;
            $records->session_year_code = $request->session_year_code;
            $records->semester = $request->semester;
            $records->department_code = $department_code;

            $records->user_id = Auth::user()->id;

            $records->bakdop_results = $request->bakdop_results;
            $records->year_final = $request->year_final;
            $records->bakdop_index = $request->bakdop_index;
            $records->bakdop_province = $request->bakdop_province;
            $records->bakdop_type = $request->bakdop_type;
            $records->scholarship = $request->scholarship;
            $records->scholarship_type = $request->scholarship_type;
            $records->submit_your_application = $request->submit_your_application;
            $records->educational_institutions = $request->educational_institutions;
            $records->save(); 

            $code_last = StudentRegistration::latest('code')->first();

            $code_transetion = \App\Service\service::Encr_string($code_last->code);
            return response()->json(['code_transetion'=> $code_transetion,'store' => 'yes', 'msg' => 'លោកអ្នកបាន ចុះឈ្មោះជោជ័យ']);
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function updateRegistration(Request $request)
    {
        $input = $request->all();
        $code = $input['type'];

        $check_classe = Student::where('code', $code)->first();

        // if ($check_classe && $check_classe->class_code) {
        //     return response()->json([
        //         'error' => 'invalid_date',
        //         'msg' => 'មិនអាចក្រែប្រែ ទិន្ន័យសិស្សបានទេ​ ឈ្មោះ' . $check_classe->name_2 . 'មាន ក្រុមរួចហើយ ' . $check_classe->class_code,
        //     ]);
        // } 
       
        $records = StudentRegistration::where('code', $code)->first();
        
        $status = ($input['status'] == 'no') ? 'no' : 'yes';
        $department_code = Skills::where('code',  $input['skills_code'])->first();
        if($department_code) {
            $department_code = $department_code->department_code;
        }
        $phone_student = $this->services->convertKhmerToEnglishNumber($request->phone_student);
        $guardian_phone = $this->services->convertKhmerToEnglishNumber($request->guardian_phone);
        // if ($request->date_of_birth = \Carbon\Carbon::parse($request->date_of_birth)->format('Ymd')) {
        //     return response()->json([
        //         'error' => 'invalid_date',
        //         'msg' => 'សូម ពិនិត្យមើល ថ្ងៃខែឆ្នាំម្ដងទៀត​!',
        //     ]);
        // }

        $date_of_birth = \Carbon\Carbon::parse($request->date_of_birth)->format('Y-m-d'); 
        try {
                $records->name_2 = $request->name_2;
                $records->name = $request->name; 
                $records->date_of_birth = $date_of_birth; 
                $records->student_address = $request->student_address;
                $records->current_address = $request->current_address;
                $records->occupation = $request->occupation; 
                $records->phone_student = $phone_student; 
                $records->guardian_name = $request->guardian_name; 
                $records->guardian_phone = $guardian_phone; 
                $records->father_name = $request->father_name; 
                $records->father_occupation = $request->father_occupation; 
                $records->mother_name = $request->mother_name; 
                $records->mother_occupation = $request->mother_occupation; 
                $records->education_Level = $request->education_Level; 
                $records->skills_code = $request->skills_code; 
                $records->sections_code = $request->sections_code; 
                $records->apply_year = $request->apply_year; 
                $records->qualification = $request->qualification; 
                $records->status = $request->status; 
                $records->register_date = Carbon::now();
                $records->study_type = "new student";
                $records->gender = $request->gender;
                $records->session_year_code = $request->session_year_code;
                $records->semester = $request->semester;
                $records->department_code = $department_code;

                $records->bakdop_results = $request->bakdop_results;
                $records->year_final = $request->year_final;
                $records->bakdop_index = $request->bakdop_index;
                $records->bakdop_province = $request->bakdop_province;
                $records->bakdop_type = $request->bakdop_type;
                $records->scholarship = $request->scholarship;
                $records->scholarship_type = $request->scholarship_type;
                $records->submit_your_application = $request->submit_your_application;
                $records->educational_institutions = $request->educational_institutions;
                $records->update(); 
            return response()->json(['status' => 'success', 'msg' => 'Data Update Success !', '$records' => $records]);
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json([
                'error' => 'invalid_date',
                'msg' => 'សូម ពិនិត្យមើល ថ្ងៃខែឆ្នាំម្ដងទៀត​!',
            ]);
        }
    }

    public function StudentDownlaodRegistrationDownlaodexcel(Request $request)
    {
        try {
            $filter = $request->all();
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

    public function update(Request $request)
    {
        $input = $request->all();
        $code = $input['code'];
        $records = Student::where('code', $code)->first();
        $status = ($input['status'] == 'no') ? 'no' : 'yes';
        try {
            $records->code = $code;
            $records->status = $status;
            $records->name = $request->name;
            $records->name_2 = $request->name_2;
            $records->date_of_birth = $request->date_of_birth;
            $records->class_code = $request->class_code;
            $records->phone_student = $request->phone_student;
            $records->skills_code = $request->skills_code;
            $records->email = $request->email;
            $records->gender = $request->gender;
            $records->student_address = $request->student_address;
            $records->father_name = $request->father_name;
            $records->father_phone = $request->father_phone;
            $records->father_occupation = $request->father_occupation;
            $records->mother_name = $request->mother_name;
            $records->mother_phone = $request->mother_phone;
            $records->mother_occupation = $request->mother_occupation;
            $records->guardian_name = $request->guardian_name;
            $records->guardian_phone = $request->guardian_phone;
            $records->guardian_occupation = $request->guardian_occupation;
            $records->guardian_address = $request->guardian_address;
            $records->study_type = $request->study_type;
            $records->department_code = $request->department_code;
            $records->sections_code = $request->sections_code;
            $records->posting_date = $request->posting_date;
            $records->update();
            return response()->json(['status' => 'success', 'msg' => 'Data Update Success !', '$records' => $records]);
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function delete(Request $request)
    {
        try {
            $code = $request->code;
            $records = Student::where('code', $code)->first();
            $records->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'msg' => 'File has been delete']);
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function DeleteRegistration(Request $request)
    {
        try {
            $code = $request->code;
            $check_classe = Student::where('code', $code)->first();

            if ($check_classe && $check_classe->class_code) {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'មិនអាចលុប ទិន្ន័យសិស្សបានទេ​ ឈ្មោះ' . $check_classe->name_2 . 'មាន ក្រុមរួចហើយ ' . $check_classe->class_code,
                ]);
            } 
            $records = StudentRegistration::where('code', $code)->first();
            $records->delete();
            DB::commit();

            return response()->json(['status' => 'success', 'msg' => 'File has been delete']);
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function SettingsCustomizeField(Request $request)
    {
        $view = view('system.setting_customize_field', compact('FieldsCustomize'))->render();
        return response()->json(['status' => 'success', 'msg' => 'Table Build Successfuly', 'view' => $view]);
        //  response()->json(['status'=>'success','msg' =>'Table Build Successfuly']);
    }

    public function IndexStudentScholarshipc(Request $request){
        $user = Auth::user();
        $sections = DB::table('sections')->get();
        $department = Department::get();
        $skills = DB::table('skills')->get();
        $qualifications = Qualifications::get();
        $total_records = StudentRegistration::select(
            DB::raw('COUNT(name) AS total_count'),  
        )->where('study_type', 'new student')
         ->where('department_code', $user->department_code)
         ->get();
       
        $records = Student::where('study_type', 'new student')
                            ->whereNotNull('scholarship')
                            ->orderBy('code', 'desc')->paginate(20);
        return view('general.student_scholarship', compact('records', 'total_records', 'qualifications', 'skills', 'department', 'sections', 'sections'));
    }
    
    public function sendmessage()
    {
        return dd('sendmessage');
    }
    public function Print(Request $request)
    {
        $data = $request->all();
        $class_record = null;
        $extract_query = $this->services->extractQuery($data);
        $user = Auth::user();
        try {
            if(isset($user->role) && $user->role == 'user_department'){
                $records = Student::whereRaw($extract_query)->where('department_code', $user->childs)->get();
            }else{
                $records = Student::whereRaw($extract_query)->get();
            }
            return view('student.student_print', compact('records', 'class_record'));
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function downlaodexcel(Request $request)
    {
        $data = $request->all();
        $class_record = null;
        $extract_query = $this->services->extractQuery($data);
        try {
            $file_name = "student";
            $records = Student::whereRaw($extract_query)->get();
            return response()->json($records);
            // return view('student.student_print', compact('records', 'class_record'));
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function Ajaxpaginat(Request $request)
    {
        $class_record = null;
        $data = $request->all();
        $extract_query = $this->services->extractQuery($data);
        try {
            $records = Student::whereRaw($extract_query)->paginate(15);
            $view = view('.general.student_list', compact('records'))->render();
            return response()->json(['status' => 'success', 'msg' => '', 'view' => $view]);
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function CreateUser(Request $request)
    {
        $data = $request->all();
        $extract_query = $this->services->extractQuery($data);

        try {
            $record = Student::where('code', $data['code'])->first();
            $name = $record->name;
            $name = strtolower($name);
            $name = str_replace([' ', 'es'], ['', 'er'], $name);
            $email = $name."@email.com";
            $check_record = User::where('user_code', $data['code'])->first();
            if ($check_record)
                return response()->json(['status' => 'error', 'msg' => 'User Student មានរូចហើយ​!']);
            $records = new User();
            $records->email = $email;
            $records->name = $name;
            $records->password = Hash::make($data['password']);
            $records->role = 'student';
            $records->department_code = Auth::user()->department_code;
            $records->user_code = $data['code'];
            $records->save();
            return response()->json(['status' => 'success', 'msg' => 'User Student Create success!']);
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function ImportExcel(Request $request){
        try{
            $data = $request->all();
            $row = Excel::toArray(new ImportExcell(),$data['excel_file']);

            $row_header = end($row);

            // $header = $row_header[0];
            // $main_data = collect([]);
            // for($i = 1 ;$i<sizeof($row_header);$i++){
            //      $collect = collect([]);
            //       for($j =0; $j < sizeof($header);$j++){
            //          $collect[$header[$j]]  = $row_header[$i][$j];
            //       }
            //       $main_data->push($collect->toArray());
            // }
            $header = $row_header[0];
            $main_data = collect([]);

            for ($i = 1; $i < sizeof($row_header); $i++) {
                $collect = collect([]);

                for ($j = 0; $j < sizeof($header); $j++) {
                    $value = $row_header[$i][$j];

                    // Check if the header is null and handle accordingly
                    if ($header[$j] !== null) {
                        // Optionally, you can set a default value for null entries
                        $collect[$header[$j]]  = $row_header[$i][$j];
                    }
                }

                $main_data->push($collect->toArray());


            }
            // dd($main_data);

            $i = 0;
            foreach ($main_data as $sub_collection) {
                // Check if the record exists
                $record_exist = Student::where('code', $sub_collection['code'])->first();

                if ($record_exist) {
                    // Update existing record
                    foreach ($sub_collection as $key => $value) {
                        if ($key === 'date_of_birth' && is_int($value)) {
                            // Convert Excel serial date number to a PHP date
                            $unixTimestamp = ($value - 25569) * 86400; // Convert days to seconds
                            $formattedDate = gmdate("Y-m-d", $unixTimestamp); // Format date as 'Y-m-d'

                            // Assign the converted date
                            $record_exist->$key = $formattedDate;
                        } else {
                            // Assign other values without changes
                            $record_exist->$key = $value;
                        }
                        // dd($record_exist);
                    }
                    // Save the updated record

                    $record_exist->save();

                } else {
                    // Create a new record if it does not exist
                    $insert_record = new Student();

                    foreach ($sub_collection as $key => $value) {
                        if ($key === 'date_of_birth' && is_int($value)) {
                            // Convert Excel serial date number to a PHP date
                            $unixTimestamp = ($value - 25569) * 86400; // Convert days to seconds
                            $formattedDate = gmdate("Y-m-d", $unixTimestamp); // Format date as 'Y-m-d'
                            $insert_record->$key = $formattedDate;
                        } else {
                            $insert_record->$key = $value;
                        }
                    }
                    $insert_record->save();
                }
            }
            return response()->json(['status' =>'success','msg' =>'Data Import Successfully']);
        }catch (\Exception $ex) {
            return response()->json(['status' => 'warning' , 'msg' => $ex->getMessage()]);
        }
    }
    public function ManageStudnetWork(Request $request){
        return view('department.manage_academic_work');
    }

    public function GetImage(Request $request){
        try {
            $code = $request->code;
            $record = null;
            $record = DB::table('picture')->where('code',$code)->get();
            $view =view('system.model_picture',compact('code','record'))->render();
            return response()->json(['status' => 'success','view' => $view]);
        } catch (\Exception $ex){ 
            return response()->json(['status' => 'warning' , 'msg' => $ex->getMessage()]);
        }
    }
    public function UploadImage(Request $request){
        DB::beginTransaction();
        try {
            $data = $request->all();
            $code = $data['code'];
            $exstain_img = Picture::where('code',$code)->first();
            if($exstain_img){
                return response()->json(['status' => 'field' , 'msg' => 'រូបភាពសិស្សមានមួយហើយមិនអាចមាន ពីបានទេ !']);
            }
            $upload_path = 'upload/student';
            $item_picture = new Picture();
            if (!file_exists($upload_path)) {
                mkdir($upload_path, 0777, true);
            }
            $fileName = $_FILES["file"]['name'];
            $fileTmpLoc = $_FILES["file"]["tmp_name"];
            $kaboom = explode(".", $fileName);
            $fileExt = end($kaboom);
            $token = openssl_random_pseudo_bytes(20);
            $token = bin2hex($token);
            $fname = $token . '.' . $fileExt;
            $moveResult = move_uploaded_file($fileTmpLoc, $upload_path . "/" . $fname);
             if($moveResult){
                $http = $request->getSchemeAndHttpHost();
                $file_path = $http.'/'. $upload_path . "/" . $fname ;
                $item_picture->picture_ori = $file_path;
                $item_picture->code = $code;
                $item_picture->type = 'student';
                $item_picture->save();
                 DB::commit();
                return response()->json(['status' => 'success' , 'msg' => 'Your changes have been successfully saved!','path' => $file_path]);
             }
             return response()->json(['status' => 'warning' , 'msg' => 'Something went wrong !']);   
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => 'warning' , 'msg' => $ex->getMessage()]);
        }
    }
    public function DeleteImage(Request $request){
        DB::beginTransaction();
        try{
            $data = $request->all();
            $record = Picture::where('id',$data['id'])->first();
            $http = $request->getSchemeAndHttpHost();
            $path_folder = str_replace($http,'',$record->picture_ori);
            $sd = public_path($path_folder);
            if (file_exists($sd)) {
                unlink($sd);
            }
            DB::commit();
            $record->delete();
            return response()->json(['status' => 'success' , 'msg' => 'File has been delete']);
        }
        catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => 'warning' , 'msg' => $ex->getMessage()]);
        } 
    }
    public function PrintRegistration(Request $request)
    {
        $data = $request->all();
        $type = $data['type'];
        try {
            $records = StudentRegistration::where('code', $data['code']) ->first();
            $skills = Skills::where('code', $records->skills_code) ->first();
           // Set the locale to Khmer
            Carbon::setLocale('km');
            $dates = Carbon::now();
            // Format the date to Khmer style
            $formattedDate = 'ថ្ងៃទី ' . $dates->day . ' ខែ ' . $dates->translatedFormat('F') . ' ឆ្នាំ ' . $dates->year;

            $date = $records->date_of_birth;
            $DateFormartKhmer = service::DateFormartKhmer($date);
            

            return view('general.student_register_print', compact('records', 'type', 'skills', 'formattedDate', 'DateFormartKhmer'));
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function StudentRemaining(Request $request)
    {
        $data = $request->all();
        $class_record = Classes::get();
        $department = Department::get();
        $skills = Skills::get();
        $sections  = Sections::get();
        $qualifications = Qualifications::get();
        try {

            $records = StudentRegistration::where('study_type', 'new student')
            ->whereNull('class_code')
            ->paginate(20);

            return view('general.student_register_remaining', compact('records', 'class_record', 'department', 'skills', 'sections', 'qualifications'));
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
}
