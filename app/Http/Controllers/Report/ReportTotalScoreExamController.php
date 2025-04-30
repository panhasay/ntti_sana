<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\General\AssingClasses;
use App\Models\General\AssingClassesStudentLine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Service\service;

class ReportTotalScoreExamController extends Controller
{
    public $services;
    public  $page;
    public $page_id = "000010";
    function __construct()
    {
        $this->services = new service();
        $this->page = 'eports-list-of-student';
    }
    public function index(Request $request){
        $data = $request->all();
        $users = Auth::user();
        
        try{
            $semester = isset($_GET['semester']) ? addslashes($_GET['semester']) : '' ;
            $records = AssingClasses::with('subject') 
                        // ->where('class_code', $data['class_code'])
                        // ->where('qualification', $type)
                        // ->where('years', $years)
                        ->where('semester', $semester)
                        ->where('exam_type', "Yes")
                        ->get();
            $assingNos = $records->pluck('assing_no');
            $lines = AssingClassesStudentLine::selectRaw('student_code')->whereIn('assing_line_no', $assingNos)
                    ->GroupBy('student_code')
                    ->get();  
            $is_print = "Yes";
            $header = AssingClasses::with('subject') 
                    // ->where('class_code', $data['class_code'])
                    // ->where('qualification', $type)
                    // ->where('years', $years)
                    ->where('semester', $semester)
                    ->where('exam_type', "Yes")
                    ->first();
            $data = $this->services->GetDateIndexOption(now()); 

            

            return view('reports.report_total_score_exam', array_merge($data, compact('users', 'records' , 'lines', 'is_print', 'header')));
        }catch (\Exception $ex) {
            return response()->json(['status' => 'warning' , 'msg' => $ex->getMessage()]);
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
    public function Priview(Request $request){
        $data = $request->all();

        dd($data);
        
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
            
            $view = view('reports.report_list_of_student_list',compact($parmas))->render();
            return response()->json(['status' =>'success','view' =>$view]);
        } catch (\Exception $ex){
            $this->services->telegram($ex->getMessage(),'list of student',$ex->getLine());
            return response()->json(['status' => 'warning' , 'msg' => $ex->getMessage()]);
        }
    }
    public function export(Request $request) 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }


}

