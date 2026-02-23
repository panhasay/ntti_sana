<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\General\Classes;
use App\Models\General\ClassStudent;
use App\Models\General\Qualifications;
use App\Models\General\StudyYears;
use App\Models\SystemSetup\Department;
use App\Service\service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpgradeClassController extends Controller
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
        $this->page = "classes";
        $this->prefix = "classes";
        $this->arrayJoin = ['10001', '10007', '10008'];
        $this->table_id = "10005";
    }
    public function index()
    {
        if (!Auth::check()) {
            return redirect("login")->withSuccess('Opps! You do not have access');
        }

        $user = Auth::user();
        $page = $this->page;
        $sessionYearCode = Auth::user()->session_year_code ?? null;
        
        $records = ClassStudent::select(
            'class_code',
            'semester',
            'years',
            'skills_code',
            'qualification',
            'session_year_code',
            'sections_code'
        )->orderBy('created_at', 'desc');

        if (!empty($sessionYearCode)) {
            $records->where('session_year_code', $sessionYearCode);
        }

        if (!empty($user->department_code)) {
            $records->where('department_code', $user->department_code);
        }

        $records = $records->groupBy(
            'class_code',
            'semester',
            'years',
            'skills_code',
            'qualification',
            'session_year_code',
            'sections_code'
        )->get();
        $data = $this->services->GetDateIndexOption(now());
        
        return view('general.upp_grade_class', array_merge($data, compact('records', 'page')));
    }
    public function transaction(request $request)
    {
        $data = $request->all();
        $type = $data['type'];
        $page = $this->page;
        $page_url = $this->page;
        $records = null;
        $user = Auth::user();
        $classs  = Classes::get();
        $sections = DB::table('sections')->get();
        $department = Department::get();
        $school_years = DB::table('session_year')->orderBy('code', 'desc')->get();
        $skills = DB::table('skills')->get();
        $qualifications = Qualifications::get();
        $study_years = StudyYears::get();
        $record_sub_lines = [''];
        try {
            $class = Classes::get();
            $params = ['records', 'type', 'page', 'sections', 'department', 'school_years', 'skills', 'qualifications', 'study_years', 'record_sub_lines', 'classs'];
            if ($type == 'cr') return view('general.upp_grade_class_card', compact($params));

            if (isset($_GET['code'])) {
                $records = Classes::where('code', $this->services->Decr_string($_GET['code']))->first();
                $record_sub_lines = ClassStudent::where('class_code', $this->services->Decr_string($_GET['code']))->where('semester', $request->semester)->where('years', $request->years);

                if (!empty($user->session_year_code)) {
                    $record_sub_lines = $record_sub_lines->where('session_year_code', $user->session_year_code);
                }

                if (!empty($user->department_code)) {
                    $record_sub_lines = $record_sub_lines->where('department_code', $user->department_code);
                }
                $record_sub_lines = $record_sub_lines->get();
            }

            return view('general.upp_grade_class_card', compact($params));
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), $this->page, $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function SelectedStudent(Request $request)
    {
        $studentCodes = $request->input('student_codes', []);

        $semester = $request->input('semester');
        $years = $request->input('years');
        $class_code = $this->services->Decr_string($request->input('class_code'));
        $sections_code = Classes::with('section')
            ->where('code', $class_code)
            ->first();

        if (empty($studentCodes)) {
            return response()->json([
                'status' => 'error',
                'message' => 'No students selected.'
            ], 400);
        }
        // Fetch selected student records
        $records = ClassStudent::with('student')
            ->whereIn('student_code', $studentCodes)
            ->where('semester', $semester)
            ->where('years', $years)
            ->where('class_code', $class_code)
            ->get();
        $session_year_codes = $records->pluck('session_year_code')->unique()->values()[0];

        $sections = DB::table('sections')->get();
        $school_years = DB::table('session_year')->orderBy('code', 'desc')->get();
        $study_years = StudyYears::get();

        if ($semester == 1) {
            $semester = 2;
        } else {
            $semester = 1;
            $years++;
        }

        if ($years > 4) {
            $years = 4;
            $semester = 2;
        }
        $semester_old = $request->input('semester');
        $years_old  = $request->input('years');

        if ($semester_old == 2) {
            $currentSession = $records->first()->session_year_codes ?? null;

            if ($currentSession) {
                list($startYear, $endYear) = explode('_', $currentSession);
                $nextSession = ((int)$startYear + 1) . '_' . ((int)$endYear + 1);
            } else {
                $nextSession = null;
            }
        } else {
            $nextSession = $session_year_codes;
        }

        // Render partial view for the modal
        $view = view('general.upp_grade_class_modal', compact('years_old', 'years_old', 'records', 'semester', 'years', 'class_code', 'sections_code', 'sections', 'school_years', 'study_years', 'nextSession'))->render();

        return response()->json([
            'status' => 'success',
            'view' => $view,
            'records' => $records,
        ]);
    }

    public function SaveUpgradedStudents(Request $request)
    {
        $studentCodes = $request->input('student_codes', []);
        $class_code = $request->input('class_code');
        $sections_code = $request->input('sections_code');
        $semester = $request->input('semester');
        $years = $request->input('years');
        $session_year_code = $request->input('session_year_code');

        if (empty($studentCodes)) {
            return response()->json([
                'status' => 'error',
                'message' => 'No students selected'
            ]);
        }

        $class = Classes::where('code', $class_code)->first();

        // 🔍 Find students already existing in this class/year/semester
        $existingStudents = ClassStudent::whereIn('student_code', $studentCodes)
            ->where('years', $years)
            ->where('semester', $semester)
            ->pluck('student_code')
            ->toArray();

        // 🆕 Filter out existing ones
        $newStudentCodes = array_diff($studentCodes, $existingStudents);

        if (empty($newStudentCodes)) {
            return response()->json([
                'status' => 'warning',
                'msg' => 'សិស្សដែលបានជ្រើសរើសទាំងអស់ត្រូវបានធ្វើឱ្យប្រសើរឡើងរួចហើយសម្រាប់ឆ្នាំនេះ និងឆមាស។'
            ]);
        }

        $newRecords = [];
        foreach ($newStudentCodes as $code) {
            $newRecords[] = [
                'student_code' => $code,
                'class_code' => $class_code,
                'sections_code' => $sections_code,
                'semester' => $semester,
                'years' => $years,
                'skills_code' => $class->skills_code,
                'qualification' => $class->level,
                'department_code' => $class->department_code,
                'session_year_code' => $session_year_code,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // 💾 Insert only the new ones
        ClassStudent::insert($newRecords);

        return response()->json([
            'status' => 'success',
            'message' => count($newRecords) . ' students upgraded successfully!',
            'already_exist' => $existingStudents, // optional: send back list of existing
        ]);
    }
}
