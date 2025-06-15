<?php

namespace App\Http\Controllers\Certificates;

use Illuminate\Http\Request;
use App\Models\General\Skills;
use App\Models\General\Classes;
use App\Models\General\Sections;
use App\Models\General\SessionYear;
use App\Http\Controllers\Controller;
use App\Models\CertificateSubModule;
use App\Models\General\Qualifications;
use App\Models\SystemSetup\Department;

class CertificateProvisionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $dept_code = $request->dept_code;
        $module_code = $request->module_code;

        $record_dept = Department::where('is_active', 'Yes')->get();
        $record_shift = Sections::where('is_active', 'Yes')->get();
        $arr_dept = Department::where('code', $dept_code)->get();
        $arr_module = CertificateSubModule::where('code', $module_code)->get();

        $record_class = Classes::select('code', 'name')
            ->where('department_code', $dept_code)
            ->distinct()
            ->get();

        $record_level = Qualifications::get();

        $record_skill = Skills::whereHas('classes', function ($query) use ($dept_code) {
            $query->whereNotNull('department_code');
        })->distinct()->get();

        $sessionYear = SessionYear::where('is_active', 'yes')
            ->orderBy('code', 'desc')
            ->first();

        return view('certificate.provisional.provisional', [
            'record_class'  => $record_class,
            'record_dept'   => $record_dept,
            'record_shift'  => $record_shift,
            'dept_code'     => $dept_code,
            'module_code'   => $module_code,
            'arr_dept'      => $arr_dept,
            'arr_module'    => $arr_module,
            'record_level'  => $record_level,
            'record_skill'  => $record_skill,
            'sessionYear'   => $sessionYear,
        ])->render();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
