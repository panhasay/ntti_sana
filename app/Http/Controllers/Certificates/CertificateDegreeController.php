<?php

namespace App\Http\Controllers\certificates;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SystemSetup\Department;

class CertificateDegreeController extends Controller
{
    public function index()
    {
        $record_dept = Department::where('is_active', 'Yes')->get();

        return view('certificate/certificate_degree_list', compact('record_dept'));
    }
}
