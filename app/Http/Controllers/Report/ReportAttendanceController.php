<?php

namespace App\Http\Controllers\Report;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportAttendanceController extends Controller
{
    public function index(Request $request)
    {
        // Logic to handle the request and return attendance report
        // This could involve fetching data from a model, processing it, and returning a view or JSON response

        return view('reports.report_attendance_student'); // Corrected view path
    }
    
}
