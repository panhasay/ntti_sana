<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExamCreditScoringExport implements FromView
{
    protected $students;

    public function __construct($students)
    {
        $this->students = $students;
    }

    public function view(): View
    {
        return view('general.exam_credit_assign_score_excel', [
            'students' => $this->students
        ]);
    }
}
