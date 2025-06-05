<?php

namespace App\Http\Controllers\Certificates;

use Illuminate\Http\Request;
use App\Models\General\Skills;
use App\Models\General\Classes;
use App\Models\General\Sections;
use App\Http\Controllers\Controller;
use App\Models\CertificateSubModule;
use App\Models\SystemSetup\Department;

class CertificateDegreeController extends Controller
{
    public function index($request)
    {
        $dept_code = $request->dept_code;
        $module_code = $request->module_code;

        $activeDepartments = Department::active()->get();
        $activeSections = Sections::active()->get();

        $departmentDetails = Department::where('code', $dept_code)->get();
        $moduleDetails = CertificateSubModule::where('code', $module_code)->get();

        $records_class = Classes::where('department_code', $dept_code ?? '')
            ->select('code', 'name')
            ->distinct()
            ->get();

        $records_level = Classes::where('department_code', $dept_code ?? '')
            ->select('level')
            ->distinct('level')
            ->get();

        $records_skill = Skills::whereHas('classes', function ($query) use ($dept_code) {
            $query->where('department_code', $dept_code);
        })->distinct()->get();

        return view('certificate.certificate_degree_list', compact(
            'activeDepartments',
            'activeSections',
            'departmentDetails',
            'moduleDetails',
            'records_class',
            'records_level',
            'records_skill'
        ));
    }
}
