<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\General\AssingClasses;
use App\Models\General\SessionYear;
use App\Service\service;
use DB;
use Carbon\Carbon;

class ExamCreditController extends Controller
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
        $this->page = "exam-credit";
        $this->prefix = "exam-credit";
        $this->arrayJoin = ['10001', '10007', '10008'];
        $this->table_id = "10005";
    }

    private function buildSessionYear($session_year)
    {
        if (!Auth::check()) {
            return redirect("login")->withSuccess('Opps! You do not have access');
        }

        $user = Auth::user();
        $page = $this->page;

        $query = AssingClasses::orderBy('session_year_code', 'desc');
        $query = $this->services->filterByUser($query, $user);

        if (!empty($session_year)) {
            $query->where('session_year_code', $session_year);
        }

        $session = $query->first();

        if (!$session) {
            return collect();
        }

        $data = $this->services->GetDateIndexOption(now());

        $records = DB::table('student_score as s')
            ->select(
                'st.code',
                'st.name_2',
                'st.gender',
                'st.class_code',
                'a.years',
                'a.semester',
                'a.session_year_code',
                DB::raw('SUM(CASE WHEN s.att_score = 0 THEN 1 ELSE 0 END) AS absent'),
                DB::raw('SUM(CASE WHEN s.att_score = 0.5 THEN 1 ELSE 0 END) AS permission')
            )
            ->join('assing_classes as a', 's.assign_line_no', '=', 'a.assing_no')
            ->join('student as st', 's.student_code', '=', 'st.code')
            ->where('a.session_year_code', $session->session_year_code)
            ->groupBy(
                'st.class_code',
                'st.code',
                'st.name_2',
                'st.gender',
                'a.years',
                'a.semester',
                'a.session_year_code'
            )
            ->having('absent', '>', 4)
            ->orderBy('st.class_code')
            ->orderBy('st.code')
            ->orderBy('a.years')
            ->orderBy('a.semester')
            ->orderBy('a.session_year_code')
            ->get();

        return $records;
    }

    public function index(Request $request){

        $records = $this->buildSessionYear(
            $request->session_year
        );

        return view ('general.exam_credit',compact('records'));
    }

    public function print(Request $request){

        $records = $this->buildSessionYear(
            $request->session_year
        );
        
        return view ('general.exam_credit_sub_lists',compact('records'));
    }

    public function excel(Request $request)
    {
        $date = Carbon::now()->format('m_d_Y'); 

        $records = $this->buildSessionYear(
            $request->session_year
        );

        $filename = "តារាងពិន្ទុនិស្សិតដែលបានប្រឡងក្រេឌីត_{$date}.xls";

        return response()->view(
            'general.exam_credit_sub_excel',
            compact('records'),
            200,
            [
                "Content-Type" => "application/vnd.ms-excel",
                "Content-Disposition" => "attachment; filename=\"$filename\""
            ]
        );
    }

}
