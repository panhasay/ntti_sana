<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\General\Picture;
use App\Models\General\StudentRegistration;
use Illuminate\Http\Request;

use App\Models\Student\Student;
use App\Models\SystemSetup\Department;
use App\Service\service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;


class ReportListOfStudentClassAndSectionController extends Controller
{
    public $services;
    public  $page;
    public $page_id = "000020";
    function __construct()
    {
        $this->services = new service();
        $this->page = 'eports-list-of-student';
    }
    public function index()
    {
        $type = null;
        try {
            $department = Department::get();;

            $records = Student::selectRaw(
                'class_code, skills_code, sections_code, department_code, qualification, session_year_code,
                COUNT(gender) AS total_students, 
                SUM(CASE WHEN gender = "ស្រី" THEN 1 ELSE 0 END) AS total_f, 
                SUM(CASE WHEN gender = "ប្រុស" THEN 1 ELSE 0 END) AS total_m'
            )
                ->whereNotNull('class_code')
                ->groupBy('class_code', 'skills_code', 'sections_code', 'department_code', 'qualification', 'session_year_code')
                ->get();

            // Process additional data for each record
            $records->map(function ($record) {
                $record->skills = DB::table('skills')->where('code', $record->skills_code)->value('name_2');
                $record->classes = DB::table('classes')->where('code', $record->class_code)->value('name');
                $record->section = DB::table('sections')->where('code', $record->sections_code)->value('name_2');
                $record->department = DB::table('department')->where('code', $record->department_code)->value('name_2');

                // Convert Date
                $record->khmerDate = isset($record->date_of_birth) ? service::convertToKhmerDate($record->date_of_birth) : null;

                // Calculate Year Difference
                $record->year_student = isset($record->posting_date) ? service::calculateDateDifference($record->posting_date) : null;

                // Student Picture
                $record->picture = Picture::where('code', $record->class_code)->where('type', 'student')->value('picture_ori');

                return $record;
            });

            return view('reports.report_list_of_student_class_and_section', compact('records', 'department', 'type'));
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->services->telegram($ex->getMessage(), 'report list Of student', $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function Priview(Request $request)
    {
        try {
            $data = $request->all();
            $filter = array_diff_key($request->all(), ['type' => '']);
            $type = $data['type'];
            $class_record = null;
            $extract_query = $this->services->extractQuery($filter);

            $records = Student::selectRaw(
                'class_code, skills_code, sections_code, department_code, qualification, session_year_code,
                COUNT(gender) AS total_students, 
                SUM(CASE WHEN gender = "ស្រី" THEN 1 ELSE 0 END) AS total_f, 
                SUM(CASE WHEN gender = "ប្រុស" THEN 1 ELSE 0 END) AS total_m'
            )
                ->whereNotNull('class_code')
                ->whereRaw($extract_query)
                ->groupBy('class_code', 'skills_code', 'sections_code', 'department_code', 'qualification', 'session_year_code')
                ->get();

            // Extract unique codes for batch queries
            $classCodes = $records->pluck('class_code')->unique()->toArray();
            $skillsCodes = $records->pluck('skills_code')->unique()->toArray();
            $sectionsCodes = $records->pluck('sections_code')->unique()->toArray();
            $departmentCodes = $records->pluck('department_code')->unique()->toArray();

            // Fetch related data in bulk to avoid multiple queries in the loop
            $skills = DB::table('skills')->whereIn('code', $skillsCodes)->pluck('name_2', 'code');
            $classes = DB::table('classes')->whereIn('code', $classCodes)->pluck('name', 'code');
            $sections = DB::table('sections')->whereIn('code', $sectionsCodes)->pluck('name_2', 'code');
            $departments = DB::table('department')->whereIn('code', $departmentCodes)->pluck('name_2', 'code');
            $pictures = Picture::whereIn('code', $classCodes)->where('type', 'student')->pluck('picture_ori', 'code');

            // Process data efficiently
            $records->map(function ($record) use ($skills, $classes, $sections, $departments, $pictures) {
                $record->skills = $skills[$record->skills_code] ?? null;
                $record->classes = $classes[$record->class_code] ?? null;
                $record->section = $sections[$record->sections_code] ?? null;
                $record->department = $departments[$record->department_code] ?? null;
                $record->picture = $pictures[$record->class_code] ?? null;

                // Convert Date
                $record->khmerDate = isset($record->date_of_birth) ? service::convertToKhmerDate($record->date_of_birth) : null;

                // Calculate Year Difference
                $record->year_student = isset($record->posting_date) ? service::calculateDateDifference($record->posting_date) : null;

                return $record;
            });

            


            $parmas = ['records', 'class_record', 'type'];
            if($type == 'is_print'){
                return view('reports.report_list_of_student_class_and_section_lists', compact($parmas));
            }
           
            if ($type == 'downlaodexcel') {
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
                $result = Excel::store(new ExportData($param), "$file_path", 'local');
                $url =  "$http/app/$file_path";
                if (!$result)   return response()->json(['status' => 'warning', 'msg' => 'Something went wrong']);
                return response()->json(['status' => 'success', 'msg' => 'Successfully export excell', 'path' => $url]);
            }
            $view = view('reports.report_list_of_student_class_and_section_lists', compact($parmas))->render();
            return response()->json(['status' => 'success', 'view' => $view]);
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), 'list of student', $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
}
