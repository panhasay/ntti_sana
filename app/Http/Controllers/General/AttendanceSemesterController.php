<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\General\ClassSchedule;

use App\Service\service;
use Illuminate\Support\Facades\Auth;
use DB;

class AttendanceSemesterController extends Controller
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
        $this->page = "attendance-semester";
        $this->prefix = "attendance-semester";
        $this->arrayJoin = ['10001', '10007', '10008'];
        $this->table_id = "10005";
    }

    public function index(){
        
        if (!Auth::check()) {
            return redirect("login")->withSuccess('Opps! You do not have access');
        }
        $user =  Auth::user();
        $page = $this->page;
            
        $classes = ClassSchedule::orderBy('semester', 'desc')
            ->orderBy('years', 'desc');
        $classes = $this->services->filterByUser($classes, $user);
        $classes = $classes->get();

        $data = $this->services->GetDateIndexOption(now()); 

        return view ('general.attendance_semester',compact('classes'));
    }

    private function buildAttendanceSemesterData($class_code, $semester, $years, $id)
    {
        $classInfo = DB::table('assing_classes')
            ->where('class_schedule_id', $id)
            ->where('class_code', $class_code)
            ->where('semester', $semester)
            ->where('years', $years)
            ->first();

        $kh_months = [
            1 => "មករា", 2 => "កម្ភៈ", 3 => "មិនា", 4 => "មេសា",
            5 => "ឧសភា", 6 => "មិថុនា", 7 => "កក្កដា", 8 => "សីហា",
            9 => "កញ្ញា", 10 => "តុលា", 11 => "វិច្ឆិកា", 12 => "ធ្នូ",
        ];

        $months = DB::table('student_score as s')
            ->join('assing_classes as a', 's.assign_line_no', '=', 'a.assing_no')
            ->when($class_code, fn($q) => $q->where('a.class_code', $class_code))
            ->when($semester, fn($q) => $q->where('a.semester', $semester))
            ->when($years, fn($q) => $q->where('a.years', $years))
            ->selectRaw("
                YEAR(s.att_date) as year,
                MONTH(s.att_date) as month,
                MIN(DAY(s.att_date)) as start_day,
                MAX(DAY(s.att_date)) as end_day
            ")
            ->groupByRaw("YEAR(s.att_date), MONTH(s.att_date)")
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $record = DB::table('student_score as s')
            ->join('assing_classes as a', 's.assign_line_no', '=', 'a.assing_no')
            ->join('student as st', 's.student_code', '=', 'st.code')
            ->when($class_code, fn($q) => $q->where('a.class_code', $class_code))
            ->when($semester, fn($q) => $q->where('a.semester', $semester))
            ->when($years, fn($q) => $q->where('a.years', $years))
            ->selectRaw("
                st.code,
                st.name_2,
                st.gender,
                YEAR(s.att_date) as year,
                MONTH(s.att_date) as month,
                SUM(CASE WHEN s.att_score = 0.5 THEN 1 ELSE 0 END) as permission,
                SUM(CASE WHEN s.att_score = 0 THEN 1 ELSE 0 END) as absent
            ")
            ->groupBy('st.code', 'st.name_2', 'st.gender', DB::raw('YEAR(s.att_date)'), DB::raw('MONTH(s.att_date)'))
            ->orderBy('st.code')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $records = [];
        foreach ($record as $rec) {
            $records[$rec->code]['code'] = $rec->code;
            $records[$rec->code]['name'] = $rec->name_2;
            $records[$rec->code]['gender'] = $rec->gender;
            $records[$rec->code]['months'][$rec->year][$rec->month] = [
                'permission' => $rec->permission,
                'absent' => $rec->absent,
            ];
        }

        return [
            'records' => $records,
            'classInfo' => $classInfo,
            'months' => $months,
            'kh_months' => $kh_months,
        ];
    }

    public function attendanceSemesterList(Request $request)
    {
        $records = $this->buildAttendanceSemesterData(
            $request->class_code,
            $request->semester,
            $request->years,
            $request->id
        );

        return view('general.attendance_semester_list', $records);
    }

    public function printAttendanceSemester(Request $request)
    {
        $records = $this->buildAttendanceSemesterData(
            $request->class_code,
            $request->semester,
            $request->years,
            $request->id
        );
        
        return view('general.attendance_semester_sub_lists', $records);
    }

}
