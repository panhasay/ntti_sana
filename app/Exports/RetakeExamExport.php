<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;

class RetakeExamExport implements FromView
{
    use Exportable;

    protected $studentsByClass;

    public function __construct($studentsByClass)
    {
        $this->studentsByClass = $studentsByClass;
    }

    public function view(): View
    {
        return view('general.retake_exam_export_excel', [
            'studentsByClass' => $this->studentsByClass
        ]);
    }
}
