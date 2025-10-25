<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\General\AssingClasses;
use App\Models\General\Classes;
use App\Models\General\HangOfStudent;
use App\Models\General\Qualifications;
use App\Models\General\StudentRegistration;
use App\Models\General\StudyYears;
use App\Models\General\Subjects;
use App\Models\General\Teachers;
use Carbon\Carbon;
use App\Models\General\TransferHeader;
use App\Models\General\TransferLine;
use App\Models\Student\Student;
use App\Models\SystemSetup\Department;
use App\Models\General\VStudentLedgerEntry;
use App\Service\service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class TransferController extends Controller
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
        $this->page = "transfer";
        $this->prefix = "transfer";
        $this->arrayJoin = ['10001', '10007', '10008'];
        $this->table_id = "10005";
    }
    public function index()
    {
        if (!Auth::check()) {
            return redirect('login')->withSuccess('Opps! You do not have access');
        }

        $page = $this->page;
        $user = Auth::user();
        $sessionYearCode = $user->session_year_code ?? null;

        // Student records
        $records = VStudentLedgerEntry::withQueryPermission()
            ->select(
                'student_code', 'class_code', 'skills_code', 'qualification', 
                'sections_code', 'years', 'session_year_code', 
                DB::raw('MAX(semester) as semester')
            )
            ->when($sessionYearCode, fn($q) => $q->where('session_year_code', $sessionYearCode))
            ->groupBy('student_code', 'class_code', 'skills_code', 'qualification', 'sections_code', 'years', 'session_year_code')
            ->orderByDesc('student_code')
            ->paginate(15);

        // Total HangOfStudent
        $total_student_HangOfStudent = HangOfStudent::when($sessionYearCode, fn($q) => $q->where('session_year_code', $sessionYearCode))
            ->count();

        // Total TransferLine
        $total_student_Transfer = TransferLine::when($sessionYearCode, fn($q) => $q->where('session_year_code', $sessionYearCode))
            ->count();

        return view('general.transfer', compact('records', 'page', 'total_student_HangOfStudent', 'total_student_Transfer'));
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
        $qualifications = Qualifications::get();

        try {
            $params = ['records', 'type', 'page', 'sections', 'department', 'school_years', 'skills', 'classs', 'study_years', 'teachers', 'subjects', 'record_sub_lines', 'date_name', 'days', 'qualifications'];
            if ($type == 'cr') return view('general.transfer_card', compact($params));

            if (isset($_GET['code'])) {
                $records = Student::where('code', $this->services->Decr_string($_GET['code']))->first();
            }

            return view('general.transfer_card', compact($params));
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

        $no =  $input['type'];

        $records = TransferHeader::where('no',  $no)->first();
        try {
            if ($records) {
                $records->class_code = $request->class_code;
                $records->transfer_to_class_code = $request->transfer_to_class_code;
                $records->sections_code = $request->sections_code;
                $records->department_code = $request->department_code;
                $records->session_year_code = $request->school_year_code;
                $records->skills_code = $request->skills_code;
                $records->qualification = $request->qualification;
                $records->semester = $request->semester;
                $records->years = $request->years;
                $records->note = $request->note;
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
        if (!$input['code']) {
            return response()->json(['status' => 'error', 'msg' => 'Field request form server!']);
        }
        $record = Skills::where('code', $request->code)->first();
        if ($record) return response()->json(['status' => 'error', 'msg' => "$request->code.កូដមានរូចហើយ​ !"]);
        try {
            $records = new Skills();
            $records->code = $request->code;
            $records->name = $request->name;
            $records->name_2 = $request->name_2;
            $records->department_code = $request->department_code;
            $records->status = $request->status;
            $records->save();
            return response()->json(['store' => 'yes', 'msg' => 'ទិន្នន័យ បន្ថែមជោគជ័យ!']);
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function Print(Request $request)
    {
        $data = $request->all();
        return dd($data);
        $class_record = null;
        $extract_query = $this->services->extractQuery($data);
        try {

            $records = Department::whereRaw($extract_query)->get();
            return view('student.student_print', compact('records', 'class_record'));
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

    public function GetStudentHangOfStudy(Request $request)
    {
        $data = $request->all();
        try {

            if (!isset($data['code']) || empty($data['code'])) {
                return response()->json(['status' => 'error', 'msg' => 'Field request form server!']);
            }

            $records = StudentRegistration::where('code', $data['code'])->first();
            return response()->json(['status' => 'success', 'records' => $records]);
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function GetStudentChangeClass(Request $request)
    {
        $code = $request->code;
        $student = VStudentLedgerEntry::withQueryPermission()
            ->with('student')
            ->select(
                'student_code',
                'class_code',
                'skills_code',
                'qualification',
                'sections_code',
                'years',
                'session_year_code',
                DB::raw('MAX(semester) as semester')
            )
            ->where('student_code', $code)
            ->groupBy(
                'student_code',
                'class_code',
                'skills_code',
                'qualification',
                'sections_code',
                'years',
                'session_year_code',
            )
            ->orderBy('student_code', 'desc')
            ->first();
            
            $sessionYearCode = Auth::user()->session_year_code ?? null;

            $class = Classes::WithQueryPermissionTeacher();

            if (!empty($sessionYearCode)) {
                $class = $class->where('school_year_code', $sessionYearCode);
            }

            $class = $class->get();

        if ($student) {
            $view = view('modals.modals_student_change_class', compact('student', 'class'))->render();
            return response()->json([
                'status' => 'success',
                'view' => $view,
                'records' => $student,
                'class' => $class
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Student not found'
            ]);
        }
    }
    public function SubmitStudentRequestHangOfStudy(Request $request)
    {
        try {
            $request->validate([
                'code' => 'required',
                'hang_of_study' => 'required',
                'from_date' => 'required|date',
                'file_name' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ]);

            // ✅ Check if student code already exists
            $existing = HangOfStudent::where('student_code', $request->code)->first();
            if ($existing) {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'សិស្សមានសំណើរម្ដងរួចហើយ។'
                ]);
            }

            $student = VStudentLedgerEntry::withQueryPermission()
                ->select('student_code', 'class_code', 'skills_code', 'qualification', 'sections_code', 'years', 'session_year_code', DB::raw('MAX(semester) as semester'))
                ->groupBy('student_code', 'class_code', 'skills_code', 'qualification', 'sections_code', 'years', 'session_year_code')
                ->orderBy('student_code', 'desc')
                ->first();


            $records = new HangOfStudent();
            $records->student_code = $request->code;
            $records->hang_of_study = $request->hang_of_study;

            $records->years = $student->years;
            $records->semester = $student->semester;
            $records->class_code = $student->class_code;
            $records->session_year_code = $student->session_year_code;
            $records->type = "Hang Of Study";
            $records->from_date = Carbon::parse($request->from_date)->format('Y-m-d');

            if ($request->hasFile('file_name')) {
                $file = $request->file('file_name');
                $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();

                $upload_path = public_path('uploads/hang_of_study');
                if (!File::exists($upload_path)) {
                    File::makeDirectory($upload_path, 0777, true);
                }

                $file->move($upload_path, $filename);
                $records->image_reference = url('uploads/hang_of_study/' . $filename);
            }

            $records->save();

            return response()->json(['status' => 'success', 'records' => $records]);
        } catch (\Exception $ex) {
            \DB::rollBack();
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }

    public function SubmitStudentRequestChangeClass(Request $request)
    {
        try {
            $existing = TransferLine::where('student_code', $request->code)->first();
            if ($existing) {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'សិស្សមានសំណើរម្ដងរួចហើយ។'
                ]);
            }

            $sections_code = Classes::where('code', $request->class_old)->value('sections_code');
            $sections_code_new = Classes::where('code', $request->class_code)->value('sections_code');
            $student_code = $request->code;

            $records = new TransferLine();
            $records->student_code = $request->code;
            $records->class_code_new = $request->class_code;
            $records->class_code = $request->class_old;
            $records->posting_date = $request->posting_date;
            $records->reason_detail = $request->reason_detail;
            $records->sections_code = $sections_code;
            $records->sections_code_new = $sections_code_new;
            $records->session_year_code = $request->session_year_code;

            $records->year = $request->year;
            $records->semester = $request->semester;
            $records->status = "Yes";
            $records->save();

            return response()->json(['status' => 'success', 'records' => $records]);
        } catch (\Exception $ex) {
            \DB::rollBack();
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
}
