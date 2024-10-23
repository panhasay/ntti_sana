<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\General\AssingClasses;
use App\Models\General\AssingClassesStudentLine;
use App\Models\General\Classes;
use App\Models\General\Subjects;
use App\Models\Student\Student;
use App\Models\SystemSetup\Department;
use App\Service\service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AssingClassesController extends Controller
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
        $this->page = "teachers";
        $this->prefix = "teachers";
        $this->arrayJoin = ['10001', '10007', '10008'];
        $this->table_id = "10005";
    }
    //
    public function index(Request $request){
        $data = $request->all();
        $type = $data['type'];
        $school_year = $data['years'];
        $user = Auth::user();
        if($user->role == "teachers"){
            $records = AssingClasses::with(['department', 'section', 'skill', 'teacher','subject' ])
                ->where('years', $data['years'])
                ->where('teachers_code', $user->user_code)
                ->where('qualification', $data['type'])
                ->paginate(20);
        }else{
            $records = AssingClasses::with(['department', 'section', 'skill', 'teacher','subject' ])
                ->where('years', $data['years'])
                ->where('qualification', $data['type'])
                ->orderBy('session_year_code', 'DESC')
                ->paginate(20);
        }
        try{
            $school_year_map = [
                '1' => '១',
                '2' => '២',
                '3' => '៣',
                '4' => '៤'
            ];
            $years = $school_year_map[$school_year] ?? '';

             return view('general.assing_classes',compact('years', 'type', 'records'));
        }catch (\Exception $ex) {
            return response()->json(['status' => 'warning' , 'msg' => $ex->getMessage()]);
        }
    }
    public function transaction(request $request)
    {
        $data = $request->all();
        $type = $data['type'];
        $page = $this->page;
        $page_url = $this->page;
        $records = null;
        $department = Department::get();
        $session_years = DB::table('session_year')->get();
        $skills = DB::table('skills')->get();
        $sections = DB::table('sections')->get();
        $teachers = DB::table('teachers')->get();
        $classes = Classes::get();
        $subjects = Subjects::get();
        $recordsLine = AssingClassesStudentLine::with(['student'])
                ->where('assing_line_no', $data['assing_no'])
                ->get();
        $Assingstudent = null;
        try {
            $params = ['records', 'type', 'page', 'skills', 'department', 'sections', 'session_years', 'classes', 'teachers', 'subjects', 'recordsLine', 'Assingstudent'];
            if ($type == 'cr') return view('general.assing_classes_card', compact($params));
            if (isset($_GET['code'])) {
                $records = AssingClasses::where('id', $this->services->Decr_string($_GET['code']))->first();
                $Assingstudent = Student::where('class_code', $records->class_code ?? '')->get();
            }

            return view('general.assing_classes_card', compact($params));
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function update(Request $request)
    {
        $input = $request->all();
        try {
            $records = AssingClasses::find($input['id']);
            if ($records) {
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
                $records->update();
            }
            return response()->json(['status' => 'success', 'msg' => 'បច្ចុប្បន្នភាព ទិន្នន័យជោគជ័យ!', '$records' => $records]);
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function AssingStudentToClass(Request $request)
    {
        $input = $request->all();
        $records = Student::where('class_code', $input['class_code'])->get();
        try {
            if ($records) {
                foreach ($records as $record) {
                    $exist = AssingClassesStudentLine::where('student_code', $record->code)
                                ->where('assing_line_no', $request->assing_no)
                                ->exists(); // This returns true if any records match the query, false otherwise

                    if (!$exist) {
                        $line = new AssingClassesStudentLine();
                        $line->student_code = $record->code;
                        $line->assing_line_no = $request->assing_no;
                        $line->save();
                    }
                }
            }
            $recordsLine = AssingClassesStudentLine::with(['student'])
            ->where('assing_line_no', $request['assing_no'])
            ->get();
            return response()->json(['status' => 'success', 'recordsLine' => $recordsLine, 'msg' => 'បច្ចុប្បន្នភាព ទិន្នន័យជោគជ័យ!', '$records' => $records]);
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }

    public function UpdateStudentLine(Request $request)
    {
        $input = $request->all();
        $assing_line_no = $input['assing_line_no'];
        $field_name = $input['name'];
        $value = $input['value'];
        $id = $input['id'];
        $student_code = $input['student_code'];

        $records = AssingClassesStudentLine::where('id', $id)->where('assing_line_no', $assing_line_no)->first();
        try {
            if ($records) {
                $records->$field_name = $request->value;
                $records->save();
            }
        $recordsLine = $records;
        $total_score = $recordsLine->attendance + $recordsLine->assessment + $recordsLine->midterm + $recordsLine->final;
            return response()->json(['status' => 'success', 'total_score' => $total_score,'msg' => 'ពិន្ទុ update!', '$records' => $records]);
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function DeleteStudentLine(Request $request)
    {
        $id = $request->id;
        try {
            $records = AssingClassesStudentLine::where('id',$id);
            $records->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'msg' => 'ទិន្ន័យត្រូវបាន លុប​!']);
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function AssingStudent(Request $request)
    {
        $code = $request->code;
        try {
            $records = Student::where('code',$code)->first();
            $exstan = AssingClassesStudentLine::where('student_code',$code)->first();;
            if ($exstan) return response()->json(['status' => 'error', 'msg' => "និស្សិតឈ្មោះ $records->name_2 មានរូចហើយ​! "]);
            $recordLine = new AssingClassesStudentLine();
            $recordLine->student_code = $records->code;
            $recordLine->save();
            DB::commit();
            return response()->json(['status' => 'success', 'msg' => "និស្សិតឈ្មោះ $records->name_2 បានបញ្ចូល! "]);
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function printLine(Request $request)
    {
        $data = $request->all();
        $type = $data['type'];
        try {
            $recordsLine = AssingClassesStudentLine::where('assing_line_no', $data['assing_no'])->get();
            $header = AssingClasses::where('assing_no', $data['assing_no'])->first();
            $subject = Subjects::where('code', $header->subjects_code)->value('name');
            return view('general.assing_classes_sub_line', compact('recordsLine', 'type', 'header', 'subject'));
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function CreateNewAssingClasses(Request $request)
    {
        $data = $request->all();
        $header = AssingClasses::latest('id')->first();
        if($header){
            $assing_no = $header->assing_no + 10;
        }else{
            $assing_no = 10;
        }
        try {
            $records = new AssingClasses();
            $records->assing_no = $assing_no;
            $records->years = $request->data_years;
            $records->qualification = $request->data_type;
            $records->save();
            return response()->json(['status' => 'success', 'msg'=> 'success']);
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function GetAttendantStudent(Request $request)
    {
        $data = $request->all();
        try {
            $records = AssingClassesStudentLine::with(['student'])
                    ->where('assing_line_no', $data['assing_no'])
                    ->get();
            $header = AssingClasses::where('assing_no', $data['assing_no'])->first();
            return view('general.assing_attendant_lists', compact('records', 'header'));

        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function UpdateAttendantDateStudent(Request $request)
    {
        $data = $request->all();
        try {
            $records = AssingClassesStudentLine::where('assing_line_no', $data['assing_no'])->get();

            foreach ($records as $record) {
                $record->{$data['name']} = $data['value']; 
                $record->save(); 
            }
            $header = AssingClasses::where('assing_no', $data['assing_no'])->first();

          
            return view('general.assing_attendant_lists', compact('records', 'header'));
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function UpdateAttendanScoretDateStudent(Request $request)
    {
        $data = $request->all();
        try {

            $records = AssingClassesStudentLine::where('assing_line_no', $data['assing_no'])
                ->where('student_code', $data['student_code'])
                ->first();
            if ($records) {
                $records->{$data['name']} = $data['value'];
                $records->update();  
            }
            return response()->json(['status' => 'success', 'msg' => 'បានដាក់ ពិន្ទុ!']);

        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function UpdateExamType(Request $request)
    {
        $data = $request->all();
        try {
            $records = AssingClasses::where('assing_no', $data['assing_no'])->first();
            if ($records) {
                $records->exam_type = 'Yes';
                $records->update();  
            }
            return response()->json(['status' => 'success', 'msg' => 'ការប្រលងបានបញ្ចាប់​!']);

        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function ExamResults(Request $request)
    {
        $data = $request->all();
        try {
            $records = AssingClasses::selectRaw("class_code, qualification, department_code, semester, session_year_code, skills_code, sections_code")
                        ->where('qualification', $data['type'])
                        ->where('years', $data['years'])
                        ->where('semester', $data['semester'])
                        ->where('exam_type', "Yes")
                        ->GroupBy('class_code', 'qualification', 'department_code', 'semester', 'session_year_code', 'skills_code', 'sections_code')
                        ->paginate(20);
            return view('general.exam_results',compact('records'));
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function GetExamResults(Request $request)
    {
        $data = $request->all();
        try {
            $records = AssingClasses::with('subject') 
                        ->where('class_code', $data['class_code'])
                        ->where('qualification', $data['type'])
                        ->where('years', $data['years'])
                        ->where('semester', $data['semester'])
                        ->where('exam_type', "Yes")
                        ->get();
                $assingNos = $records->pluck('assing_no');
                $lines = AssingClassesStudentLine::selectRaw('student_code')->whereIn('assing_line_no', $assingNos)
                        ->GroupBy('student_code')
                        ->get();   
            return response()->json([
                'status' => 'success',
                'msg' => 'Quantity Updated Successfully!',
                'records_order' => $records,
                'html' => view('general.exam_results_record_modal', [
                    'records' => $records,
                    'lines' => $lines
                ])->render()
            ]);

        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function PrintExamResults(Request $request)
    {
        $data = $request->all();
        try {
            $years = isset($_GET['years']) ? addslashes($_GET['years']) : '' ;
            $type = isset($_GET['type']) ? addslashes($_GET['type']) : '' ;
            $semester = isset($_GET['semester']) ? addslashes($_GET['semester']) : '' ;
            $records = AssingClasses::with('subject') 
                        ->where('class_code', $data['class_code'])
                        ->where('qualification', $type)
                        ->where('years', $years)
                        ->where('semester', $semester)
                        ->where('exam_type', "Yes")
                        ->get();
            $assingNos = $records->pluck('assing_no');
            $lines = AssingClassesStudentLine::selectRaw('student_code')->whereIn('assing_line_no', $assingNos)
                    ->GroupBy('student_code')
                    ->get();  
            $is_print = "Yes";
            $header = AssingClasses::with('subject') 
                    ->where('class_code', $data['class_code'])
                    ->where('qualification', $type)
                    ->where('years', $years)
                    ->where('semester', $semester)
                    ->where('exam_type', "Yes")
                    ->first();
            return view('general.exam_results_record_modal', compact('records' , 'lines', 'is_print', 'header'));

        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
}
