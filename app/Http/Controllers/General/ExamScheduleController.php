<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\General\AssingClasses;
use App\Models\General\Classes;
use App\Models\General\ClassSchedule as GeneralClassSchedule;
use App\Models\General\ExamSchedule;
use App\Models\General\ExamScheduleLine;
use App\Models\General\StudyYears;
use App\Models\General\Subjects;
use App\Models\General\Teachers;
use App\Models\SystemSetup\Department;
use App\Service\service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Models\General\ClassSchedule;

class ExamScheduleController extends Controller
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
        $this->page = "exam-schedule";
        $this->prefix = "exam-schedule";
        $this->arrayJoin = ['10001', '10007', '10008'];
        $this->table_id = "10005";
    }
    public function index()
    {
        $page = $this->page;
        $records = ExamSchedule::orderBy('session_year_code', 'asc')->paginate(20);
        if (!Auth::check()) {
            return redirect("login")->withSuccess('Opps! You do not have access');
        }
        return view('general.exam_schedule', compact('records', 'page'));
    }
    public function saveExamSchedule(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->all();
            $header = ExamSchedule::findOrFail($data['exam_schedule']);

            $dates = $request->input('date');
            $subjects = $request->input('subjects_code');
            $teachers = $request->input('teacher_code');
            $documents = $request->input('document_exam');

            foreach ($dates as $key => $date) {
                if (!empty($date) && !empty($subjects[$key])) {
                    ExamScheduleLine::create([
                        'exam_schedule_id' => $header->id,
                        'date' => $date,
                        'subjects_code' => $subjects[$key],
                        'teacher_code' => $teachers[$key] ?? null,
                        'document_exam' => $documents[$key] ?? null,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }

            DB::commit();
            return response()->json([
                'status' => 'success',
                'msg' => 'Exam Schedule saved successfully!'
            ]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'msg' => $ex->getMessage()
            ]);
        }
    }

    public function updateExamSchedule(Request $request, $id)
    {
        try {
            $record = ExamScheduleLine::findOrFail($id);
            $record->update([
                'date' => $request->input('date'),
                'subjects_code' => $request->input('subjects_code'),
                'teacher_code' => $request->input('teacher_code'),
                'updated_at' => now()
            ]);

            return response()->json([
                'status' => 'success',
                'msg' => 'Exam Schedule updated successfully!'
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => 'error',
                'msg' => $ex->getMessage()
            ]);
        }
    }

    public function deleteExamSchedule($id)
    {
        try {
            $record = ExamScheduleLine::findOrFail($id); // Check if record exists
            $record->delete(); // Perform delete

            return response()->json([
                'status' => 'success',
                'msg' => 'Exam Schedule deleted successfully!'
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => 'error',
                'msg' => $ex->getMessage()
            ]);
        }
    }


    public function transaction(request $request)
    {
        $data = $request->all();
        $type = $data['type'];
        $page = $this->page;
        $page_url = $this->page;
        $records = null;
        $record_sub_lines = ExamScheduleLine::where('id', '')->get();
        $classs = Classes::orderBy('code', 'desc')->get();
        $sections = DB::table('sections')->get();
        $department = Department::get();
        $school_years = DB::table('session_year')->orderBy('code', 'desc')->get();
        $skills = DB::table('skills')->get();
        $study_years = StudyYears::get();
        $teachers = Teachers::orderBy('code', 'asc')->get();
        $subjects = Subjects::orderBy('code', 'asc')->get();
        try {
            $params = ['records', 'type', 'page', 'sections', 'department', 'school_years', 'skills', 'classs', 'study_years', 'teachers', 'subjects', 'record_sub_lines'];
            if ($type == 'cr') return view('general.exam_schedule_card', compact($params));
            if (isset($_GET['code'])) {
                $records = ExamSchedule::where('id', $this->services->Decr_string($_GET['code']))->first();
                $record_sub_lines = ExamScheduleLine::where('exam_schedule_id', $records->id)->get();
            }
            return view('general.exam_schedule_card', compact($params));
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function delete(Request $request)
    {
        $code = $request->code;
        try {
            $records = Skills::where('code', $code);
            $records->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'msg' => 'ទិន្ន័យត្រូវបាន លុប​!']);
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function update(Request $request)
    {
        $input = $request->all();
        $code = $input['type'];
        $record = ExamSchedule::where('id', $code)->first();
        if (!$record) return response()->json(['status' => 'error', 'msg' => "មិនអាចកែប្រ លេខកូដ!"]);
        try {
            $records = ExamSchedule::where('id', $code)->first();
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
            $records = new ExamSchedule();
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

            $record = ExamSchedule::latest('id')->first();
            if (isset($record->id)) {
                $encryptedCode = \App\Service\service::Encr_string($record->id);
                $url = "/exam-schedule/transaction?type=ed&code=" . $encryptedCode;
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

        if ($assing) {
            $assing_no = $assing->assing_no + 10;
        } else {
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

 public function uploadDocument(Request $request)
 {
     $code = $request->query('code'); 
 
     $request->validate([
         'document_exam' => 'required|mimes:pdf|max:10240', 
     ]);
 
     $record = ExamScheduleLine::find($code);
 
     if (!$record) {
         return response()->json(['status' => 'error', 'message' => 'Record not found'], 404);
     }
 
     try {
         if (!empty($record->document_exam) && file_exists(public_path('storage/' . $record->document_exam))) {
             unlink(public_path('storage/' . $record->document_exam));
         }
         if ($request->hasFile('document_exam') && $request->file('document_exam')->isValid()) {
             $file = $request->file('document_exam');
             $directory = public_path('storage/documents/exam');
             if (!file_exists($directory)) {
                 mkdir($directory, 0777, true); 
             }
             $filename = time() . '_' . $file->getClientOriginalName();
             $file->move($directory, $filename);
             $filePath = 'documents/exam/' . $filename;
             $record->document_exam = $filePath;
             $record->save();
 
             return response()->json([
                 'status' => 'success',
                 'message' => 'File uploaded successfully',
                 'path' => $filePath,
             ]);
         }

     } catch (\Exception $e) {
         // Catch and log any exceptions
         \Log::error('File upload error:', ['error' => $e->getMessage()]);
         return response()->json([
             'status' => 'error',
             'message' => 'An error occurred during file upload. Please try again.',    
         ], 500);
     }
 }

 public function deleteExamScheduleLine($id)
 {
     $record = ExamScheduleLine::find($id);
 
     if (!$record) {
         return response()->json(['status' => 'error', 'message' => 'Record not found'], 404);
     }
 
     try {
         $record->delete();
         return response()->json(['status' => 'success', 'message' => 'Record and file deleted successfully']);
     } catch (\Exception $e) {
        //  \Log::error('Error deleting record:', ['error' => $e->getMessage()]);
         return response()->json(['status' => 'error', 'message' => 'Failed to delete record. Please try again.'], 500);
     }
 }
 public function viewPdf($filename)
 {
     $filePath = public_path('storage/documents/exam/' . $filename);

     if (!file_exists($filePath)) {
         abort(404, 'File not found');
     }

     return response()->file($filePath, [
         'Content-Type' => 'application/pdf',
         'Content-Disposition' => 'inline; filename="' . basename($filePath) . '"',
     ]);
 }

    
}
