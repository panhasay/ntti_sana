<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\General\StudentRegistration;
use Illuminate\Http\Request;

use App\Models\Student\Student;
use App\Models\SystemSetup\Department;
use App\Service\service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;


class ReportFirstYearStudentRegistrationController extends Controller
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
            
            $today = Carbon::today()->toDateString();
            $records = StudentRegistration::select(
                'qualification',
                'qualification as apply_year',
                'skills_code',
                DB::raw('COUNT(code) AS total_count'), 
                DB::raw('SUM(CASE WHEN gender = "ស្រី" THEN 1 ELSE 0 END) AS total_count_girl'),
                DB::raw('SUM(CASE WHEN DATE(register_date) = "' . $today . '" THEN 1 ELSE 0 END) AS total_count_today'),
                DB::raw('SUM(CASE WHEN DATE(register_date) = "' . $today . '" AND gender = "ស្រី" THEN 1 ELSE 0 END) AS total_count_today_girl'), 
                DB::raw('SUM(CASE WHEN register_date > "' . $today . ' 23:59:59" THEN 1 ELSE 0 END) AS total_count_before_today'), 
                DB::raw('SUM(CASE WHEN register_date > "' . $today . ' 23:59:59" AND gender = "ស្រី" THEN 1 ELSE 0 END) AS total_count_before_today_girl')
            )
            ->where('study_type', 'new student')
            ->groupBy('qualification', 'apply_year', 'skills_code') 
            ->get()
            ->groupBy(['qualification', 'qualification as apply_year']);    

            $data = $this->services->GetDateIndexOption(now()); 

            return view('reports.report_first_year_student_registration', array_merge($data, compact('records')));	
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->services->telegram($ex->getMessage(), 'report list Of student', $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function Priview(Request $request){
        try {
            $data = $request->all();
            $filter = array_diff_key($request->all(), ['type' => '']);
            $type = $data['type'];
            $class_record = null;
            $extract_query = $this->services->extractQueryRaw($filter);

            // dd($extract_query);

            $today = Carbon::today()->toDateString();
            $records = StudentRegistration::select(
                'qualification',
                'qualification as apply_year',
                'skills_code',
                DB::raw('COUNT(code) AS total_count'), 
                DB::raw('SUM(CASE WHEN gender = "ស្រី" THEN 1 ELSE 0 END) AS total_count_girl'),
                DB::raw('SUM(CASE WHEN DATE(register_date) = "' . $today . '" THEN 1 ELSE 0 END) AS total_count_today'),
                DB::raw('SUM(CASE WHEN DATE(register_date) = "' . $today . '" AND gender = "ស្រី" THEN 1 ELSE 0 END) AS total_count_today_girl'), 
                DB::raw('SUM(CASE WHEN register_date > "' . $today . ' 23:59:59" THEN 1 ELSE 0 END) AS total_count_before_today'), 
                DB::raw('SUM(CASE WHEN register_date > "' . $today . ' 23:59:59" AND gender = "ស្រី" THEN 1 ELSE 0 END) AS total_count_before_today_girl')
            )
            ->whereRaw($extract_query)
            ->where('study_type', 'new student')
            ->groupBy('qualification', 'skills_code') 
            ->get()
            ->groupBy(['qualification', 'qualification as apply_year']);  

          
            $parmas = ['records','class_record','type'];

            // if($type == 'print'){
            //     return view('reports.report_list_of_student_list', compact($parmas));
            // }

            $view = view('reports.report_first_year_student_registration_list',compact($parmas))->render();
            return response()->json(['status' =>'success','view' =>$view]);
        } catch (\Exception $ex){
            $this->services->telegram($ex->getMessage(),'list of student',$ex->getLine());
            return response()->json(['status' => 'warning' , 'msg' => $ex->getMessage()]);
        }
    }
    


}
