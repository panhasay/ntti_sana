<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\General\Skills;
use App\Models\Student\Student;
use Illuminate\Http\Request;
use App\Service\service;

class ApiController extends Controller
{
    public function APIGetStudent(Request $request)
    {
        $data = $request->all();
        try {

            $code = $data['code'];
            $numericCode = preg_replace('/[^0-9]/', '', $code);
            
            $records = Student::leftJoin('picture', 'student.code', '=', 'picture.code')
                ->leftJoin('skills', 'student.skills_code', '=', 'skills.code') // Adding another left join for skills
                ->select('student.*', 'picture.picture_ori', 'skills.name_2 as skils_name') // Select fields from both tables
                ->where('student.code', '=', $numericCode)
                ->get();

            return response()->json(['records' => $records], 200);
        } catch (\Exception $ex) {
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
}
