<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Service\service;
use App\Exports\RetakeExamExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class RetakeExamController extends Controller
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
        $this->page = "retake-exam";
        $this->prefix = "retake-exam";
        $this->arrayJoin = ['10001', '10007', '10008'];
        $this->table_id = "10005";
    }

    public function index(Request $request)
    {
        // Get all students initially
        $studentsByClass = $this->getFilteredStudents();

        // Get class code from request or default
        $class_code = $request->class_code ?? null;

        return view('general.retake_exam', compact('studentsByClass', 'class_code'));
    }

    // AJAX live search method
    public function liveSearch(Request $request)
    {
        $search = $request->get('search');
        $studentsByClass = $this->getFilteredStudents($search);

        return view('general.retake_exam_record', compact('studentsByClass'))->render();
    }

    // Helper function to fetch and process students
    private function getFilteredStudents($search = null)
    {
        $studentsRaw = DB::table('assing_classes_student_line as asl')
            ->join('assing_classes as ac', 'asl.assing_line_no', '=', 'ac.assing_no')
            ->join('student as s', 'asl.student_code', '=', 's.code')
            ->join('subjects as sub', 'ac.subjects_code', '=', 'sub.code')
            ->select(
                'asl.student_code',
                's.name_2 as student_name',
                's.gender',
                'ac.class_code',
                'ac.years as year',
                'ac.semester',
                'sub.name as subject_name',
                DB::raw('(
                    COALESCE(asl.attendance,0) + 
                    COALESCE(asl.assessment,0) + 
                    COALESCE(asl.midterm,0) + 
                    COALESCE(asl.final,0)
                ) AS total_score')
            )
            ->when($search, function($query, $search) {
                $query->where('s.name_2', 'like', "%{$search}%")
                    ->orWhere('asl.student_code', 'like', "%{$search}%")
                    ->orWhere('ac.class_code', 'like', "%{$search}%");
            })
            ->orderBy('ac.class_code')
            ->orderBy('asl.student_code')
            ->get()
            ->groupBy('student_code');

        $filtered = collect();

        foreach ($studentsRaw as $studentCode => $studentSubjects) {
            $sortedSubjects = collect($studentSubjects)->sortBy('student_name');

            // Calculate average score
            $sum = $sortedSubjects->sum('total_score');
            $count = $sortedSubjects->count();
            $avg = $count > 0 ? $sum / $count : 0;

            // Find failed subjects (<50 score)
            $failedSubjects = $sortedSubjects->filter(fn($subject) => $subject->total_score < 50);
            $failedSubjectsCount = $failedSubjects->count();
            $failedSubjectNames = $failedSubjects->pluck('subject_name')->toArray();

            // Only include students whose AVERAGE is < 50
            if ($avg < 50) {
                $filtered->push([
                    'student_code'          => $studentCode,
                    'student_name'          => $sortedSubjects->first()->student_name,
                    'gender'                => $sortedSubjects->first()->gender,
                    'class_code'            => $sortedSubjects->first()->class_code,
                    'year'                  => $sortedSubjects->first()->year,
                    'semester'              => $sortedSubjects->first()->semester,
                    'average_score'         => round($avg, 2), // average instead of one subject
                    'failed_subjects_count' => $failedSubjectsCount,
                    'failed_subjects'       => $failedSubjectNames,
                ]);
            }
        }

        return $filtered->groupBy('class_code')->map(fn($group) => $group->sortBy('student_name'));
    }


    public function exportExcel(Request $request)
    {
        $search = $request->get('search', null);

        // Use the same helper function to get filtered students
        $studentsByClass = $this->getFilteredStudents($search);
        $date = Carbon::now()->format('Y-m-d');

        // Export to Excel
        return Excel::download(new RetakeExamExport($studentsByClass), "បញ្ជីប្រឡងសង_{$date}.xlsx");
    }
    public function printList(Request $request)
    {
        $search = $request->get('search', null);
        // Use the helper function to get filtered students
        $studentsByClass = $this->getFilteredStudents($search);
        // Flatten for totals
        $records = $studentsByClass->flatten();
        $totalStudents = $records->count();
        $totalFemale = $records->where('gender', 'ស្រី')->count();
        $is_print = 'Yes';

        $html = view('general.retake_exam_print_list', compact(
            'studentsByClass', 'is_print', 'records', 'totalStudents', 'totalFemale'
        ))->render();

        return response()->json([
            'status' => 'success',
            'html' => $html,
        ]);
    }

}
