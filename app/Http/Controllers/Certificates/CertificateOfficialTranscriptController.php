<?php

namespace App\Http\Controllers\Certificates;

use App\Models\StudentModel;
use App\Service\mPDFService;
use Illuminate\Http\Request;
use App\Models\General\Skills;
use Illuminate\Support\Carbon;
use App\Models\General\Classes;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\General\Sections;
use Illuminate\Support\Facades\DB;
use App\Models\general\SessionYear;
use Illuminate\Support\Facades\App;
use Spatie\Browsershot\Browsershot;
use App\Http\Controllers\Controller;
use App\Models\CertificateSubModule;
use Illuminate\Support\Facades\View;
use App\Models\General\AssingClasses;
use Illuminate\Support\Facades\Crypt;
use App\Models\General\Qualifications;
use App\Models\SystemSetup\Department;
use Illuminate\Support\Facades\Response;
use KhmerPdf\LaravelKhPdf\Facades\PdfKh;
use Spatie\LaravelPdf\Facades\Pdf as SpatiePDF;
use App\Models\General\AssingClassesStudentLine;
use App\Models\Certificates\CertificateOfficialTranscript;
use App\Models\Certificates\CertStudentOfficialTranscriptCode;

class CertificateOfficialTranscriptController extends Controller
{
    public function __construct() {}

    public function index(Request $request)
    {
        $module_code = $request->module_code;

        $record_dept = Department::where('is_active', 'Yes')->get();
        $record_shift = Sections::where('is_active', 'Yes')->get();
        $arr_dept = Department::get();
        $arr_module = CertificateSubModule::where('code', $module_code)->get();

        $record_class = Classes::select('code', 'name')
            ->distinct()
            ->get();

        $record_level = Qualifications::whereNotNull('name_3')->get();

        $record_skill = Skills::whereHas('classes')->get();

        $sessionYear = SessionYear::where('is_active', 'yes')
            ->orderBy('code', 'desc')
            ->first();

        return view('certificate.transcript.transcript', [
            'record_class'  => $record_class,
            'record_dept'   => $record_dept,
            'record_shift'  => $record_shift,
            'module_code'   => $module_code,
            'arr_dept'      => $arr_dept,
            'arr_module'    => $arr_module,
            'record_level'  => $record_level,
            'record_skill'  => $record_skill,
            'sessionYear'   => $sessionYear,
        ])->render();
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'stu_code' => 'required|string|max:50',
            'class_code' => 'required|string|max:50',
        ]);

        $validated['stu_code'] = $request->stu_code;
        $validated['status'] = 1;

        $year = substr((string) Carbon::now()->year, -2);
        $lastRecord = CertificateOfficialTranscript::whereNotNull('reference_code')
            ->latest('id')
            ->first();
        if ($lastRecord && preg_match('/^\d{5}/', $lastRecord->reference_code, $matches)) {
            $lastNumber = (int) $matches[0];
        } else {
            $lastNumber = 0;
        }

        $record_class = Classes::whereNotNull('code')
            ->where('code', $request->class_code ?? 0)
            ->first();
        $qualification_code = $record_class->level;
        $skills_code = $record_class->skills_code;

        $record_offical_code = CertStudentOfficialTranscriptCode::where('active', 1)
            ->where('qualification_code', $qualification_code)
            ->where('skills_code', $skills_code)
            ->first();

        $code = $record_offical_code->code;

        $newNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);
        $newReferenceCode = "{$newNumber}/{$year} NTTI/{$code}";
        $validated['off_code'] = $code;
        $validated['reference_code'] = $newReferenceCode;
        $validated['print_date'] = now();

        $existingRecord = CertificateOfficialTranscript::where('stu_code', $request->stu_code)
            ->where('class_code', $request->class_code)
            ->where('status', 1)
            ->first();
        if ($existingRecord) {
            $record = '';
            $status = 404;
            $message = "ទិន្នន័យមានរួចរាល់ {$request->stu_code}!";
        } else {
            $record = CertificateOfficialTranscript::create($validated);
            $status = 200;
            $message = "បង្កើតលេខកូដសញ្ញាបត្រជោគជ័យ {$request->stu_code}!";
        }

        return response()->json(['status' => $status, 'data' => $message, 'message' => $message]);
    }

    public function update(Request $request, $id)
    {
        $record = CertificateOfficialTranscript::findOrFail($id);

        $validated = $request->validate([
            'stu_code' => 'nullable|string|max:50',
            'class_code' => 'nullable|string|max:50',
            'print_by' => 'nullable|integer',
            'print_by_date' => 'nullable|date',
            'update_by' => 'nullable|integer',
            'update_by_date' => 'nullable|date',
            'status' => 'nullable|integer',
        ]);
        $record->update($validated);

        return response()->json(['message' => 'Record updated successfully', 'data' => $record], 200);
    }

    public function show11(Request $request)
    {
        $dept_code = $request->input('dept_code');
        $class_code = $request->input('class_code');
        $qualification = $request->input('qualification');
        $sections_code = $request->input('sections_code');
        $skills_code = $request->input('skills_code');

        $search = $request->input('search');
        $page = $request->input('page', 1);
        $rows_per_page = $request->input('rows_per_page', 50);

        $object = [];
        $object['dept_code'] = $dept_code;
        $object['class_code'] = $class_code;
        $object['qualification'] = $qualification;
        $object['sections_code'] = $sections_code;
        $object['skills_code'] = $skills_code;

        $object['search'] = $search;
        $object['rows_per_page'] = $rows_per_page;


        $students = StudentModel::getFilteredStudentsTranscript($object);
        $students->transform(function ($student) {
            $student->stu_photo = DB::table('picture')
                ->where('code', $student->code)
                ->orderByDesc('id')
                ->value('picture_ori');

            $filePath = public_path('uploads/student/' . $student->stu_photo);

            $student->photo_status = $student->stu_photo && file_exists($filePath) ? true : false;

            $student->keyword = secured_encrypt($student->code);

            $record_assign_no = AssingClasses::where('class_code', $student->class_code)
                ->orderByDesc('session_year_code')
                ->first();
            $student->record_assign_no = $record_assign_no;

            $record_print = CertificateOfficialTranscript::where('stu_code', $student->code)
                ->where('class_code', $student->class_code)
                ->orderByDesc('id')
                ->first();
            $student->record_print = $record_print;

            return $student;
        });
        return response()->json([
            'data' => $students->items(),
            'current_page' => $students->currentPage(),
            'last_page' => $students->lastPage(),
            'page' => $students->perPage(),
            'links' => $students->links('pagination::pagination-synoeun')->toHtml()
        ]);
    }

    public function show(Request $request)
    {
        $dept_code = $request->input('dept_code');
        $class_code = $request->input('class_code');
        $qualification = $request->input('qualification');
        $sections_code = $request->input('sections_code');
        $skills_code = $request->input('skills_code');

        $search = $request->input('search');
        $rows_per_page = $request->input('rows_per_page', 20);

        $students = StudentModel::query()
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

        $students->getCollection()->transform(function ($student) {
            $student->stu_photo = DB::table('picture')
                ->where('code', $student->code)
                ->orderByDesc('id')
                ->value('picture_ori');

            $filePath = public_path('uploads/student/' . $student->stu_photo);

            $student->photo_status = $student->stu_photo && file_exists($filePath) ? true : false;

            $encrypted = secured_encrypt($student->code);
            $student->keyword = $encrypted;

            $record_assign_no = AssingClasses::where('class_code', $student->class_code)
                ->orderByDesc('years')
                ->orderByDesc('semester')
                ->first();
            $student->record_assign_no = $record_assign_no;

            $record_print = CertificateOfficialTranscript::where('stu_code', $student->code)
                ->where('class_code', $student->class_code)
                ->orderByDesc('id')
                ->first();
            $student->record_print = $record_print;

            return $student;
        });

        return response()->json([
            'data' => $students->items(),
            'current_page' => $students->currentPage(),
            'last_page' => $students->lastPage(),
            'page' => $students->perPage(),
            'links' => $students->links('pagination::pagination-synoeun')->toHtml()
        ]);
    }

    public function showClass(Request $request)
    {
        $dept_code = $request->input('dept_code');

        $query = Classes::whereNotNull('department_code');

        if ($dept_code != 'all') {
            $query->where('department_code', $dept_code);
        }

        $records_class = $query->select('*')
            ->distinct('code')
            ->get();

        return response()->json($records_class);
    }

    public function showInfo(Request $request)
    {
        $key = $request->key;

        $stu_code = Crypt::decrypt($key);

        $record = CertificateOfficialTranscript::where('stu_code', $stu_code)->orderBy('id', 'desc')->first();
        $records_info = StudentModel::where('code', $stu_code)
            ->select('name', 'name_2', 'code', 'gender', 'date_of_birth', 'qualification')
            ->orderBy('id', 'desc')
            ->first();

        $data = CertStudentOfficialTranscriptCode::with(
            [
                'qualification:code,name,name_3',
                'skill:code,name,name_2'
            ]
        )->where('active', 1)->where('code', $record->off_code ?? '')
            ->get()
            ->map(function ($item) {
                return [
                    'code' => $item->code,
                    'level_eng' => $item->qualification->name ?? '',
                    'level_kh' => $item->qualification->name_3 ?? '',
                    'skill_eng' => $item->skill->name ?? '',
                    'skill_kh' => $item->skill->name_2 ?? '',
                    'full_name' => ($item->qualification->name ?? 'N/A') . ' Of ' . ($item->skill->name ?? 'N/A'),
                ];
            });
        return view('certificate.transcript.transcript_info', [
            'stu_code'  => $stu_code,
            'record'  => $record ?? [],
            'records_info'  => $records_info,
            'records_transcript'  => $data,
        ])->render();
    }
    public function showPrint(Request $request)
    {
        $key = $request->key;

        $stu_code = secured_decrypt($key);

        $record = CertificateOfficialTranscript::where('stu_code', $stu_code)->orderBy('id', 'desc')->first();
        $records_info = StudentModel::where('code', $stu_code)
            ->select('name', 'name_2', 'code', 'gender', 'date_of_birth', 'qualification')
            ->orderBy('id', 'desc')
            ->first();

        $data = CertStudentOfficialTranscriptCode::with(
            [
                'qualification:code,name,name_3',
                'skill:code,name,name_2'
            ]
        )->where('active', 1)->where('code', $record->off_code ?? '')
            ->get()
            ->map(function ($item) {
                return [
                    'code' => $item->code,
                    'level_eng' => $item->qualification->name ?? '',
                    'level_kh' => $item->qualification->name_3 ?? '',
                    'skill_eng' => $item->skill->name ?? '',
                    'skill_kh' => $item->skill->name_2 ?? '',
                    'full_name' => ($item->qualification->name ?? 'N/A') . ' Of ' . ($item->skill->name ?? 'N/A'),
                ];
            });


        $subjects = DB::table('assing_classes_student_line as ass')
            ->join('assing_classes as acl', 'acl.assing_no', '=', 'ass.assing_line_no')
            ->join('subjects as su', 'su.code', '=', 'acl.subjects_code')
            ->where('ass.student_code', $stu_code)
            ->select(
                'acl.years',
                'acl.semester',
                'su.name_2 as sub_kh',
                'su.name as sub_eng',
                DB::raw('(IFNULL(SUM(ass.final), 0) + IFNULL(SUM(ass.attendance), 0) + IFNULL(SUM(ass.assessment), 0) + IFNULL(SUM(ass.midterm), 0)) AS score')
            )
            ->groupBy('acl.assing_no', 'acl.years', 'acl.semester', 'su.name_2', 'su.name')
            ->orderBy('acl.years', 'asc')
            ->orderBy('acl.semester', 'asc')
            ->get();



        $record_print = CertificateOfficialTranscript::where('stu_code', $stu_code)
            ->select('print_date')
            ->orderByDesc('id')
            ->first();
        //dd($record_print);

        $groupedSubjects = $subjects->groupBy(['years', 'semester']);

        $html = view('certificate.transcript.transcript_print_pdf', [
            'stu_code'  => $stu_code,
            'record'  => $record ?? [],
            'records_info'  => $records_info,
            'records_transcript'  => $data,
            'records_subjects'  => $groupedSubjects,
            'record_print'  => $record_print,
        ])->render();
        $pdf = PdfKh::loadHTML($html);
        $pdf->addMPdfConfig([
            'mode' => 'utf-8',
            'format' => 'A4-P',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 15,
            'margin_bottom' => 15,
            'defaultBodyCSS' => [
                'background' => 'none',
            ],
        ]);

        return $pdf->stream('ntti-offical-transcript.pdf');
    }
    public function showPrintV2(Request $request)
    {
        $key = $request->key;

        $stu_code = secured_decrypt($key);

        $record = CertificateOfficialTranscript::where('stu_code', $stu_code)->orderBy('id', 'desc')->first();
        $records_info = StudentModel::where('code', $stu_code)
            ->select('name', 'name_2', 'code', 'gender', 'date_of_birth', 'qualification')
            ->orderBy('id', 'desc')
            ->first();

        $data = CertStudentOfficialTranscriptCode::with(
            [
                'qualification:code,name,name_3',
                'skill:code,name,name_2'
            ]
        )->where('active', 1)->where('code', $record->off_code ?? '')
            ->get()
            ->map(function ($item) {
                return [
                    'code' => $item->code,
                    'level_eng' => $item->qualification->name ?? '',
                    'level_kh' => $item->qualification->name_3 ?? '',
                    'skill_eng' => $item->skill->name ?? '',
                    'skill_kh' => $item->skill->name_2 ?? '',
                    'full_name' => ($item->qualification->name ?? 'N/A') . ' Of ' . ($item->skill->name ?? 'N/A'),
                ];
            });


        $subjects = DB::table('assing_classes_student_line as ass')
            ->join('assing_classes as acl', 'acl.assing_no', '=', 'ass.assing_line_no')
            ->join('subjects as su', 'su.code', '=', 'acl.subjects_code')
            ->where('ass.student_code', $stu_code)
            ->select(
                'acl.years',
                'acl.semester',
                'su.name_2 as sub_kh',
                'su.name as sub_eng',
                DB::raw('(IFNULL(SUM(ass.final), 0) + IFNULL(SUM(ass.attendance), 0) + IFNULL(SUM(ass.assessment), 0) + IFNULL(SUM(ass.midterm), 0)) AS score')
            )
            ->groupBy('acl.assing_no', 'acl.years', 'acl.semester', 'su.name_2', 'su.name')
            ->orderBy('acl.years', 'asc')
            ->orderBy('acl.semester', 'asc')
            ->get();



        $record_print = CertificateOfficialTranscript::where('stu_code', $stu_code)
            ->select('print_date')
            ->orderByDesc('id')
            ->first();

        $groupedSubjects = $subjects->groupBy(['years', 'semester']);

        $html = view('certificate.transcript.transcript_print_pdf_v2', [
            'stu_code'  => $stu_code,
            'record'  => $record ?? [],
            'records_info'  => $records_info,
            'records_transcript'  => $data,
            'records_subjects'  => $groupedSubjects,
            'record_print'  => $record_print,
        ])->render();
        $pdf = PdfKh::loadHTML($html);
        $pdf->addMPdfConfig([
            'mode' => 'utf-8',
            'format' => 'A4-P',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 15,
            'margin_bottom' => 15,
        ]);

        return $pdf->stream('ntti-offical-transcript.pdf');
    }
    public function showPrintV3(Request $request)
    {
        $key = $request->key;

        $stu_code = secured_decrypt($key);

        $record = CertificateOfficialTranscript::where('stu_code', $stu_code)->orderBy('id', 'desc')->first();
        $records_info = StudentModel::where('code', $stu_code)
            ->select('name', 'name_2', 'code', 'gender', 'date_of_birth', 'qualification')
            ->orderBy('id', 'desc')
            ->first();

        $data = CertStudentOfficialTranscriptCode::with(
            [
                'qualification:code,name,name_3',
                'skill:code,name,name_2'
            ]
        )->where('active', 1)->where('code', $record->off_code ?? '')
            ->get()
            ->map(function ($item) {
                return [
                    'code' => $item->code,
                    'level_eng' => $item->qualification->name ?? '',
                    'level_kh' => $item->qualification->name_3 ?? '',
                    'skill_eng' => $item->skill->name ?? '',
                    'skill_kh' => $item->skill->name_2 ?? '',
                    'full_name' => ($item->qualification->name ?? 'N/A') . ' Of ' . ($item->skill->name ?? 'N/A'),
                ];
            });


        $subjects = DB::table('assing_classes_student_line as ass')
            ->join('assing_classes as acl', 'acl.assing_no', '=', 'ass.assing_line_no')
            ->join('subjects as su', 'su.code', '=', 'acl.subjects_code')
            ->where('ass.student_code', $stu_code)
            ->select(
                'acl.years',
                'acl.semester',
                'su.name_2 as sub_kh',
                'su.name as sub_eng',
                DB::raw('(IFNULL(SUM(ass.final), 0) + IFNULL(SUM(ass.attendance), 0) + IFNULL(SUM(ass.assessment), 0) + IFNULL(SUM(ass.midterm), 0)) AS score')
            )
            ->groupBy('acl.assing_no', 'acl.years', 'acl.semester', 'su.name_2', 'su.name')
            ->orderBy('acl.years', 'asc')
            ->orderBy('acl.semester', 'asc')
            ->get();



        $record_print = CertificateOfficialTranscript::where('stu_code', $stu_code)
            ->select('print_date')
            ->orderByDesc('id')
            ->first();

        $groupedSubjects = $subjects->groupBy(['years', 'semester']);

        $html = view('certificate.transcript.transcript_print_pdf_v3', [
            'stu_code'  => $stu_code,
            'record'  => $record ?? [],
            'records_info'  => $records_info,
            'records_transcript'  => $data,
            'records_subjects'  => $groupedSubjects,
            'record_print'  => $record_print,
        ])->render();
        $pdfContent = Browsershot::html($html)
            ->format('A4')
            ->showBackground()
            ->pdf();

        return response($pdfContent, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="invoice.pdf"');

        // $tempPath = storage_path('app/public/official-transcript.pdf');
        // SpatiePDF::view('certificate.transcript.transcript_print_pdf_v3', [
        //     'stu_code'  => $stu_code,
        //     'record'  => $record ?? [],
        //     'records_info'  => $records_info,
        //     'records_transcript'  => $data,
        //     'records_subjects'  => $groupedSubjects,
        //     'record_print'  => $record_print,
        // ])
        //     ->format('a4')
        //     ->showBackground()
        //     ->name('official-transcript.pdf')
        //     ->save($tempPath);
        // return Response::make(file_get_contents($tempPath), 200, [
        //     'Content-Type' => 'application/pdf',
        //     'Content-Disposition' => 'inline; filename="official-transcript.pdf"',
        // ]);
    }

    public function showTotalStudent(Request $request)
    {
        $dept_code = $request->input('dept_code');
        $class_code = $request->input('class_code');
        $qualification = $request->input('qualification');
        $sections_code = $request->input('sections_code');
        $skills_code = $request->input('skills_code');

        $genderCounts = StudentModel::query()
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
    public function generateOfficalTranscriptPDF()
    {
        $html = view('certificate.certificate_official_transcript_mpdf_print')->render();
        $pdf = PdfKh::loadHTML($html);
        $pdf->addMPdfConfig([
            'mode' => 'utf-8',
            'format' => 'A4-P',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 15,
            'margin_bottom' => 15,
        ]);

        return $pdf->stream('document.pdf');
    }

    public function print(Request $request)
    {
        $key = $request->key;

        $stu_code = Crypt::decrypt($key);

        $record = CertificateOfficialTranscript::where('stu_code', $stu_code)->orderBy('id', 'desc')->first();
        $records_info = StudentModel::where('code', $stu_code)
            ->select('name', 'name_2', 'code', 'gender', 'date_of_birth', 'qualification')
            ->orderBy('id', 'desc')
            ->first();

        $data = CertStudentOfficialTranscriptCode::with(
            [
                'qualification:code,name,name_3',
                'skill:code,name,name_2'
            ]
        )->where('active', 1)->where('code', $record->off_code ?? '')
            ->get()
            ->map(function ($item) {
                return [
                    'code' => $item->code,
                    'level_eng' => $item->qualification->name ?? '',
                    'level_kh' => $item->qualification->name_3 ?? '',
                    'skill_eng' => $item->skill->name ?? '',
                    'skill_kh' => $item->skill->name_2 ?? '',
                    'full_name' => ($item->qualification->name ?? 'N/A') . ' Of ' . ($item->skill->name ?? 'N/A'),
                ];
            });

        $subjects = DB::table('assing_classes_student_line as ass')
            ->join('assing_classes as acl', 'acl.assing_no', '=', 'ass.assing_line_no')
            ->join('subjects as su', 'su.code', '=', 'acl.subjects_code')
            ->where('ass.student_code', $stu_code)
            ->where('acl.years', 1)
            ->where('acl.semester', 1)
            ->select('acl.year', 'su.name_2 as sub_kh', 'su.name as sub_eng')
            ->get();

        $html =  view('certificate.transcript.transcript', [
            'stu_code'  => $stu_code,
            'record'  => $record ?? [],
            'records_info'  => $records_info,
            'records_transcript'  => $data,
            'records_subjects'  => $subjects,
        ])->render();

        return $html;
    }

    public function generateOfficalTranscriptdomPDF()
    {
        $data = [
            'name' => 'John Doe'
        ];
        $fontPath = public_path('fonts/Battambang-Bold.ttf');

        $pdf = Pdf::loadView('certificate.transcript.transcript-dompdf', $data)
            ->setPaper('A4', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ]);

        return $pdf->stream('document.pdf');
    }
}
