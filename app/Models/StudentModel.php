<?php

namespace App\Models;

use App\Models\General\Skills;
use App\Models\General\Classes;
use App\Models\General\Picture;
use Illuminate\Support\Facades\DB;
use App\Models\SystemSetup\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentModel extends Model
{
    use HasFactory;

    protected $table = 'student';

    /**
     * department
     *
     * @return void
     */
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_code', 'code');
    }

    /**
     * class
     *
     * @return void
     */
    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_code', 'code');
    }

    public function pictures()
    {
        return $this->hasMany(Picture::class, 'code', 'code');
    }


    public static function getFilteredStudents11($dept_code, $class_code, $search, $rows_per_page)
    {
        $query = self::with(['department:name_2,code', 'class:name,code,level,skills_code'])
            ->where('department_code', $dept_code)
            ->whereNotNull('class_code');

        if (!empty($class_code)) {
            $query->where('class_code', $class_code);
        }

        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                $query->where('student.code', 'LIKE', "%{$search}%")
                    ->orWhere('student.name', 'LIKE', "%{$search}%")
                    ->orWhere('student.name_2', 'LIKE', "%{$search}%");
            });
        }

        return $query->paginate($rows_per_page);
    }
    public static function getFilteredStudents1($dept_code, $class_code, $search, $rows_per_page)
    {
        $students = self::query()
            ->select([
                'student.*',
                'dept.name_2 as dept',
                'cls.name as class',
                'cls.level as level',
                'sk.name_2 as skill',
                DB::raw('(SELECT stu.status FROM cert_student_print_card AS stu WHERE stu.stu_code = student.code AND stu.class_code = student.class_code LIMIT 1) as status_print'),
                DB::raw('(SELECT pic.picture_ori FROM picture AS pic WHERE pic.code = student.code ORDER BY pic.id DESC LIMIT 1) as stu_photo'),
                DB::raw('(SELECT stu.print_code FROM cert_student_print_card AS stu WHERE stu.stu_code = student.code AND stu.class_code = student.class_code LIMIT 1) as print_code')
            ])
            ->join('department as dept', 'dept.code', '=', 'student.department_code')
            ->join('classes as cls', 'cls.code', '=', 'student.class_code')
            ->join('skills as sk', 'sk.code', '=', 'cls.skills_code')
            ->whereNotNull('student.department_code')
            ->whereNotNull('student.class_code')
            ->when($class_code, function ($query, $class_code) {
                $query->where('student.class_code', $class_code);
            })
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('student.code', 'LIKE', "%{$search}%")
                        ->orWhere('student.name', 'LIKE', "%{$search}%")
                        ->orWhere('student.name_2', 'LIKE', "%{$search}%");
                });
            })
            ->orderBy('student.name_2', 'asc')
            ->paginate($rows_per_page);

        return $students;
    }

    public static function getFilteredStudents($dept_code, $class_code, $search, $rows_per_page)
    {
        $students = self::query()
            ->select([
                'student.id',
                'student.code',
                'student.name',
                'student.name_2',
                'student.gender',
                'student.date_of_birth',
                'student.phone_student',
                'student.department_code',
                'student.class_code',
                'dept.name_2 as dept',
                'cls.name as class',
                'cls.level as level',
                'sk.name_2 as skill',
                DB::raw('IFNULL((SELECT stu.id FROM cert_student_print_card AS stu WHERE stu.stu_code = student.code AND stu.class_code = student.class_code LIMIT 1), 0) as print_card_id'),
                DB::raw('IFNULL((SELECT stu.status FROM cert_student_print_card AS stu WHERE stu.stu_code = student.code AND stu.class_code = student.class_code LIMIT 1), 0) as status_print'),
                DB::raw('IFNULL((SELECT pic.picture_ori FROM picture AS pic WHERE pic.code = student.code ORDER BY pic.id DESC LIMIT 1), "") as stu_photo'),
                DB::raw('IFNULL((SELECT stu.print_code FROM cert_student_print_card AS stu WHERE stu.stu_code = student.code AND stu.class_code = student.class_code LIMIT 1), "") as print_code')
            ])
            ->join('department as dept', 'dept.code', '=', 'student.department_code')
            ->join('classes as cls', 'cls.code', '=', 'student.class_code')
            ->join('skills as sk', 'sk.code', '=', 'cls.skills_code')
            ->whereNotNull('student.department_code')
            ->whereNotNull('student.class_code')
            ->when($dept_code, function ($query, $dept_code) {
                $query->where('student.department_code', $dept_code);
            })
            ->when($class_code, function ($query, $class_code) {
                $query->where('student.class_code', $class_code);
            })
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('student.code', 'LIKE', "%{$search}%")
                        ->orWhere('student.name', 'LIKE', "%{$search}%")
                        ->orWhere('student.name_2', 'LIKE', "%{$search}%");
                });
            })
            ->orderBy('student.name_2', 'asc')
            ->paginate($rows_per_page);

        return $students;
    }


    public static function getFilteredStudentsOnly($dept_code, $class_code = null, $stu_code = null)
    {
        return self::query()
            ->select([
                'student.*',
                DB::raw('dept.name_2 as dept'),
                DB::raw('cls.name as class'),
                DB::raw('cls.level as level'),
                DB::raw('sk.name_2 as skill'),
                DB::raw('(SELECT stu.name_2 FROM sections AS stu WHERE stu.code = cls.sections_code LIMIT 1) as section_type'),
                DB::raw('(SELECT pic.picture_ori FROM picture AS pic WHERE pic.code = student.code ORDER BY pic.id DESC LIMIT 1) as stu_photo')
            ])
            ->join('department as dept', 'dept.code', '=', 'student.department_code')
            ->join('classes as cls', 'cls.code', '=', 'student.class_code')
            ->join('skills as sk', 'sk.code', '=', 'cls.skills_code')
            ->where('student.department_code', $dept_code)
            ->when($class_code, function ($query, $class_code) {
                $query->where('student.class_code', $class_code);
            })
            ->when($stu_code, function ($query, $stu_code) {
                $query->where('student.code', $stu_code);
            })
            ->first();
    }

    public static function getShowCardTotalStudent($dept_code, $class_code)
    {
        $genderCounts = self::query()
            ->selectRaw("COUNT(CASE WHEN student.gender = 'ប្រុស' THEN 1 END) as total_male")
            ->selectRaw("COUNT(CASE WHEN student.gender = 'ស្រី' THEN 1 END) as total_female")
            ->selectRaw("COUNT(CASE WHEN student.gender = 'ប្រុស' AND
            (SELECT stu.status FROM cert_student_print_card AS stu
             WHERE stu.stu_code = student.code
             AND stu.class_code = student.class_code
             LIMIT 1) = 1 THEN 1 END) as total_male_status_1")
            ->selectRaw("COUNT(CASE WHEN student.gender = 'ស្រី' AND
            (SELECT stu.status FROM cert_student_print_card AS stu
             WHERE stu.stu_code = student.code
             AND stu.class_code = student.class_code
             LIMIT 1) = 1 THEN 1 END) as total_female_status_1")
            ->join('department as dept', 'dept.code', '=', 'student.department_code')
            ->join('classes as cls', 'cls.code', '=', 'student.class_code')
            ->join('skills as sk', 'sk.code', '=', 'cls.skills_code')
            ->whereNotNull('student.department_code')
            ->whereNotNull('student.class_code')
            ->when($dept_code, function ($query, $dept_code) {
                $query->where('student.department_code', $dept_code);
            })
            ->when($class_code, function ($query, $class_code) {
                $query->where('student.class_code', $class_code);
            })
            ->first();

        return [
            'total_male' => $genderCounts->total_male,
            'total_female' => $genderCounts->total_female,
            'total_students' => $genderCounts->total_male + $genderCounts->total_female,
            'total_male_status_1' => $genderCounts->total_male_status_1,
            'total_female_status_1' => $genderCounts->total_female_status_1,
            'total_status_1' => $genderCounts->total_male_status_1 + $genderCounts->total_female_status_1,
        ];
    }


    public static function getFilteredStudentsTranscript($object = [])
    {
        $dept_code = $object['dept_code'];
        $class_code = $object['class_code'];
        $qualification = $object['qualification'];
        $sections_code = $object['sections_code'];
        $skills_code = $object['skills_code'];

        $search = $object['search'];
        $rows_per_page = $object['rows_per_page'];

        $students = self::query()
            ->select([
                'student.*',
                'dept.name_2 as dept',
                'cls.name as class',
                'cls.level as level',
                'sk.name_2 as skill',
                DB::raw('(SELECT stu.name_2 FROM sections AS stu WHERE stu.code = cls.sections_code LIMIT 1) as section_type'),
                DB::raw('(SELECT stu.status FROM cert_student_print_card AS stu WHERE stu.stu_code = student.code AND stu.class_code = student.class_code LIMIT 1) as status_print'),
                DB::raw('(SELECT pic.picture_ori FROM picture AS pic WHERE pic.code = student.code ORDER BY pic.id DESC LIMIT 1) as stu_photo'),
                DB::raw('(SELECT stu.print_code FROM cert_student_print_card AS stu WHERE stu.stu_code = student.code AND stu.class_code = student.class_code LIMIT 1) as print_code')
            ])
            ->join('department as dept', 'dept.code', '=', 'student.department_code')
            ->join('classes as cls', 'cls.code', '=', 'student.class_code')
            ->join('skills as sk', 'sk.code', '=', 'cls.skills_code')
            ->whereNotNull('student.department_code')
            ->whereNotNull('student.class_code')
            ->when($dept_code, function ($query, $dept_code) {
                if ($dept_code != 'all') {
                    $query->where('cls.department_code', $dept_code);
                }
            })
            ->when($class_code, function ($query, $class_code) {
                if ($class_code != 'all') {
                    $query->where('student.class_code', $class_code);
                }
            })
            ->when($qualification, function ($query, $qualification) {
                if ($qualification != 'all') {
                    $query->where('student.qualification', $qualification);
                }
            })
            ->when($sections_code, function ($query, $sections_code) {
                if ($sections_code != 'all') {
                    $query->where('cls.sections_code', $sections_code);
                }
            })
            ->when($skills_code, function ($query, $skills_code) {
                if ($skills_code != 'all') {
                    $query->where('cls.skills_code', $skills_code);
                }
            })
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('student.code', 'LIKE', "%{$search}%")
                        ->orWhere('student.name', 'LIKE', "%{$search}%")
                        ->orWhere('student.name_2', 'LIKE', "%{$search}%");
                });
            })
            ->orderBy('student.name_2', 'asc')
            ->paginate($rows_per_page);

        return $students;
    }



    public static function getShowTranScriptTotalStudent($request)
    {
        $dept_code = $request->input('dept_code');
        $class_code = $request->input('class_code');
        $qualification = $request->input('qualification');
        $sections_code = $request->input('sections_code');
        $skills_code = $request->input('skills_code');

        $genderCounts = self::query()
            ->selectRaw("COUNT(CASE WHEN student.gender = 'ប្រុស' THEN 1 END) as total_male")
            ->selectRaw("COUNT(CASE WHEN student.gender = 'ស្រី' THEN 1 END) as total_female")
            ->selectRaw("COUNT(CASE WHEN student.gender = 'ប្រុស' AND
            (SELECT stu.status FROM cert_student_official_transcript AS stu
             WHERE stu.stu_code = student.code
             AND stu.class_code = student.class_code
             LIMIT 1) = 1 THEN 1 END) as total_male_status_1")
            ->selectRaw("COUNT(CASE WHEN student.gender = 'ស្រី' AND
            (SELECT stu.status FROM cert_student_official_transcript AS stu
             WHERE stu.stu_code = student.code
             AND stu.class_code = student.class_code
             LIMIT 1) = 1 THEN 1 END) as total_female_status_1")
            ->join('department as dept', 'dept.code', '=', 'student.department_code')
            ->join('classes as cls', 'cls.code', '=', 'student.class_code')
            ->join('skills as sk', 'sk.code', '=', 'cls.skills_code')
            ->whereNotNull('student.department_code')
            ->whereNotNull('student.class_code')
            ->when($dept_code, function ($query, $dept_code) {
                if ($dept_code != 'all') {
                    $query->where('cls.department_code', $dept_code);
                }
            })
            ->when($class_code, function ($query, $class_code) {
                if ($class_code != 'all') {
                    $query->where('student.class_code', $class_code);
                }
            })
            ->when($qualification, function ($query, $qualification) {
                if ($qualification != 'all') {
                    $query->where('student.qualification', $qualification);
                }
            })
            ->when($sections_code, function ($query, $sections_code) {
                if ($sections_code != 'all') {
                    $query->where('cls.sections_code', $sections_code);
                }
            })
            ->when($skills_code, function ($query, $skills_code) {
                if ($skills_code != 'all') {
                    $query->where('cls.skills_code', $skills_code);
                }
            })
            ->first();

        return [
            'total_male' => $genderCounts->total_male,
            'total_female' => $genderCounts->total_female,
            'total_students' => $genderCounts->total_male + $genderCounts->total_female,
            'total_male_status_1' => $genderCounts->total_male_status_1,
            'total_female_status_1' => $genderCounts->total_female_status_1,
            'total_status_1' => $genderCounts->total_male_status_1 + $genderCounts->total_female_status_1,
        ];
    }
}
