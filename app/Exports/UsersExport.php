<?php

namespace App\Exports;

use App\Models\Student\Student;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class UsersExport implements FromView
// FromCollection, WithHeadings
{
    public function view(): View
    {
        $records= DB::table('classes')
                    ->join('class_sections', 'classes.id', '=', 'class_sections.class_id')
                    ->join('sections', 'sections.id', '=', 'class_sections.section_id')
                    ->join('student_session', 'student_session.class_id', '=', 'classes.id')
                    ->join('students', 'student_session.student_id', '=', 'students.id')
                    ->join('department', 'department.id', '=', 'classes.depart_id')
                    ->join('sessions', 'sessions.id', '=', 'student_session.session_id')
                    ->join('categories', 'categories.id', '=', 'students.category_id')
                    ->selectRaw("classes.class, sections.section, department.department_name, sessions.session, categories.category
                        ,COUNT(students.firstname) as qty_studen
                        ,COUNT(CASE WHEN students.gender = 'ស្រី' THEN students.firstname END) as qty_studen_female
                        ,COUNT(CASE WHEN students.gender = 'ប្រុស' THEN students.firstname END) as qty_studen_male
                    ")
                    // ->whereRaw($creterial_department)
                    // ->whereRaw($creterial_years)
                    // ->whereRaw($creterial_category)
                    // ->whereRaw($creterial_class)
                    ->groupBy('sections.section', 'classes.class', 'department.department_name', 'sessions.session', 'categories.category')
                    ->orderBy('classes.class', 'asc')
                    ->get();
        // return view('admin.component.table_list',$this->data); 
        // return view('reports.report_list_of_student_list'); 
        return view('reports.report_list_of_student_list', [
            'records' => $records,
            'type' => 'donwloadexcel',
        ]);

    } 
   
}