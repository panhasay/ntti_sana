<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\General\student_score;
use App\Models\General\AssingClasses;
use App\Models\General\Subjects;
use App\Models\Student\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ScoreController extends Controller
{
    public function index()
    {
        try {
            // Get all scores grouped by student and assignment with subject information
            $scores = student_score::with(['student'])
                ->select(
                    'student_score.student_code',
                    'student_score.assign_line_no',
                    'student_score.created_at',
                    'student_score.att_score',
                    'assing_classes.subjects_code'
                )
                ->join('assing_classes', 'student_score.assign_line_no', '=', 'assing_classes.assing_no')
                ->get();

            // Group scores by student and assignment
            $groupedScores = collect();
            foreach ($scores->groupBy(['student_code', 'assign_line_no']) as $studentScores) {
                foreach ($studentScores as $assignmentScores) {
                    $firstRecord = $assignmentScores->first();
                    if ($firstRecord) {
                        $groupedScores->push([
                            'student_code' => $firstRecord->student_code,
                            'student' => $firstRecord->student,
                            'assign_line_no' => $firstRecord->assign_line_no,
                            'subjects_code' => $firstRecord->subjects_code,
                            'first_teaching_date' => $assignmentScores->min('created_at'),
                            'last_teaching_date' => $assignmentScores->max('created_at'),
                            'total_score' => $assignmentScores->sum('att_score'),
                            'total_assessments' => $assignmentScores->count(),
                            'teaching_days' => Carbon::parse($assignmentScores->max('created_at'))
                                ->diffInDays(Carbon::parse($assignmentScores->min('created_at'))) + 1
                        ]);
                    }
                }
            }

            // Get all subjects
            $subjects = Subjects::pluck('name', 'code');

            // Transform and group the data
            $scoresByStudent = $groupedScores->map(function ($record) use ($subjects) {
                return [
                    'student_code' => $record['student_code'],
                    'student_name' => $record['student']->name ?? '',
                    'student_name_2' => $record['student']->name_2 ?? '',
                    'class_code' => $record['student']->class_code ?? '',
                    'assign_line_no' => $record['assign_line_no'],
                    'subject_code' => $record['subjects_code'],
                    'subject_name' => $subjects[$record['subjects_code']] ?? 'Unknown Subject',
                    'total_score' => $record['total_score'],
                    'total_assessments' => $record['total_assessments'],
                    'teaching_days' => $record['teaching_days'],
                    'first_teaching_date' => $record['first_teaching_date'],
                    'last_teaching_date' => $record['last_teaching_date'],
                    'average_score' => $record['total_assessments'] > 0 ? 
                        round($record['total_score'] / $record['total_assessments'], 2) : 0
                ];
            });

            // Group by class code and subject
            $scoresByClassAndSubject = $scoresByStudent->groupBy(['class_code', 'subject_code']);
            
            // Calculate subject statistics
            $subjectStats = $scoresByStudent->groupBy('subject_code')->map(function ($subjectScores) use ($subjects) {
                $subjectCode = $subjectScores->first()['subject_code'];
                return [
                    'subject_name' => $subjects[$subjectCode] ?? 'Unknown Subject',
                    'total_students' => $subjectScores->count(),
                    'average_class_score' => round($subjectScores->avg('average_score'), 2),
                    'total_teaching_days' => $subjectScores->max('teaching_days'),
                    'highest_score' => $subjectScores->max('total_score'),
                    'lowest_score' => $subjectScores->min('total_score'),
                    'first_teaching_date' => $subjectScores->min('first_teaching_date'),
                    'last_teaching_date' => $subjectScores->max('last_teaching_date')
                ];
            });
            
            return response()->json([
                'status' => 'success',
                'data' => [
                    'scores_by_class_and_subject' => $scoresByClassAndSubject,
                    'subject_statistics' => $subjectStats,
                    'total_students' => $groupedScores->unique('student_code')->count(),
                    'total_subjects' => $groupedScores->unique('subjects_code')->count()
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ], 500);
        }
    }

   
}
