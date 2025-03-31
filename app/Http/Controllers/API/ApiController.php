<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\General\Skills;
use App\Models\Student\Student;
use Illuminate\Http\Request;
use App\Service\service;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function APIGetStudent(Request $request)
    {
        $data = $request->all();
        try {

            $code = $data['code'];
            $numericCode = preg_replace('/[^0-9]/', '', $code);
            
            // $records = Student::leftJoin('picture', 'student.code', '=', 'picture.code')
            // ->leftJoin('skills', 'student.skills_code', '=', 'skills.code') 
            // ->leftJoin('qualification', 'student.qualification', '=', 'qualification.code') 
            // ->leftJoin('cert_student_print_card_expire_class', 'student.class_code', '=', 'cert_student_print_card_expire_class.class_code') 
            // ->select('student.*', 'picture.picture_ori', 'skills.name_2 as skills_name', 'cert_student_print_card_expire_class.expire_date', 'qualification.name_3') 
            // ->where('student.code', '=', $numericCode)
            // ->get();

            $records = Student::leftJoin('picture', DB::raw("CONVERT(picture.code USING utf8mb4) COLLATE utf8mb4_unicode_ci"), '=', DB::raw("CONVERT(student.code USING utf8mb4) COLLATE utf8mb4_unicode_ci"))
                ->leftJoin('skills', DB::raw("CONVERT(skills.code USING utf8mb4) COLLATE utf8mb4_unicode_ci"), '=', DB::raw("CONVERT(student.skills_code USING utf8mb4) COLLATE utf8mb4_unicode_ci"))
                ->leftJoin('qualification', DB::raw("CONVERT(qualification.code USING utf8mb4) COLLATE utf8mb4_unicode_ci"), '=', DB::raw("CONVERT(student.qualification USING utf8mb4) COLLATE utf8mb4_unicode_ci"))
                ->leftJoin('cert_student_print_card_expire_class', DB::raw("CONVERT(cert_student_print_card_expire_class.class_code USING utf8mb4) COLLATE utf8mb4_unicode_ci"), '=', DB::raw("CONVERT(student.class_code USING utf8mb4) COLLATE utf8mb4_unicode_ci"))
                ->select('student.*', 'picture.picture_ori', 'skills.name_2 as skills_name', 'cert_student_print_card_expire_class.expire_date', 'qualification.name_3')
                ->where(DB::raw("CONVERT(student.code USING utf8mb4) COLLATE utf8mb4_unicode_ci"), '=', $numericCode)
                ->get();

            return response()->json(['records' => $records], 200);
        } catch (\Exception $ex) {
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
}
