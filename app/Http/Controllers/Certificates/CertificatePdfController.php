<?php

namespace App\Http\Controllers\certificates;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf as PDF;

class CertificatePdfController extends Controller
{
    public function generatePdf()
    {
        $data = [
            'name' => 'John Doe',
            'id' => '500695',
            'gender' => 'Male',
            'dob' => '06 April 2005',
            'major' => 'Information Technology',
            'level' => 'Bachelor',
            'issue_date' => '02 January 2024',
        ];
        $pdf = PDF::loadView('certificate/certificate_card_print', $data, [], [
            'format' => [65, 99],
        ]);

        $pdf->SetProtection(['copy', 'print'], '', 'pass');

        //return $pdf->download('example.pdf');
        return $pdf->stream('student_card.pdf');
    }
}
