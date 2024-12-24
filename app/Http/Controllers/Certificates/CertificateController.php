<?php

namespace App\Http\Controllers\Certificates;

use Illuminate\Http\Request;
use App\Models\General\Skills;
use App\Models\General\Classes;
use App\Models\General\Sections;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\CertificateSubModule;
use App\Models\Student\Student;
use App\Models\SystemSetup\Department;


class CertificateController extends Controller
{  
    public function showLevelShiftSkill(Request $request)
    {
        $class_code = $request->input('class_code');
        $query = Classes::where('code', $class_code ?? '');

        $record_level = $query->select('*')
            ->distinct('level')
            ->get();

        return response()->json(array(
            'record_level' => $record_level,
        ));
    }

    public function showCardView(Request $request)
    {
        $dept_code = $request->dept_code;
        $class_code = $request->class_code;
        $search = $request->search;

        $query = DB::table('student AS stu')
            ->select(
                'stu.*',
                DB::raw("(SELECT dept.name_2 FROM department AS dept WHERE dept.code = stu.department_code LIMIT 1) AS dept"),
                DB::raw("(SELECT cls.name FROM classes AS cls WHERE cls.code = stu.class_code LIMIT 1) AS class")
            )
            ->where('stu.department_code', $dept_code)
            ->whereNotNull('stu.class_code');

        if (!empty($class_code)) {
            $query->where('class_code', $class_code ?? '');
        }
        if (!empty($search)) {
            $query->Where('stu.code', 'LIKE', "%{$search}%");
            $query->orWhere('stu.name_2', 'LIKE', "%{$search}%");
            $query->orWhere('stu.name', 'LIKE', "%{$search}%");
        }
        $students = $query->get();
        return response()->json(array(
            'record' => $students,
        ));
    }
}


// $record_skill = Skills::whereHas('classes', function ($query) use ($dept_code) {
//     $query->where('department_code', $dept_code);
// })->distinct()->get();
