<?php

namespace App\Http\Controllers\Certificates;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\StudentModel;
use Illuminate\Http\Request;
use App\Models\General\Skills;
use App\Models\General\Classes;
use App\Models\General\Sections;
use Illuminate\Support\Facades\DB;
use Spatie\Browsershot\Browsershot;
use App\Http\Controllers\Controller;
use App\Models\CertificateSubModule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\General\AssingClasses;
use App\Models\General\Qualifications;
use App\Models\SystemSetup\Department;
use App\Models\Certificates\CertStudentStatus;
use App\Models\Certificates\CertStudentOfficialTranscriptCode;

class CertificateStudentStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $module_code = $request->module_code;

        $record_dept = Department::where('is_active', 'Yes')->get();
        $record_shift = Sections::where('is_active', 'Yes')->get();
        $arr_module = CertificateSubModule::where('code', $module_code)->get();

        $record_class = Classes::select('code', 'name')
            ->distinct()
            ->get();

        $record_level = Qualifications::get();

        $record_skill = Skills::whereHas('classes')->get();

        return view('certificate.student_status.student_status', [
            'record_class'  => $record_class,
            'record_dept'   => $record_dept,
            'record_shift'  => $record_shift,
            'module_code'   => $module_code,
            'arr_module'    => $arr_module,
            'record_level'  => $record_level,
            'record_skill'  => $record_skill,
        ])->render();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        $lastRecord = CertStudentStatus::whereNotNull('reference_code')
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
        $newReferenceCode = "{$newNumber}/{$year} វ.ជ.ប.ប";
        $validated['off_code'] = $code;
        $validated['reference_code'] = $newReferenceCode;
        $validated['print_date'] = now();

        $existingRecord = CertStudentStatus::where('stu_code', $request->stu_code)
            ->where('class_code', $request->class_code)
            ->where('status', 1)
            ->first();
        if ($existingRecord) {
            $record = '';
            $status = 404;
            $message = "ទិន្នន័យមានរួចរាល់ {$request->stu_code}!";
        } else {
            $record = CertStudentStatus::create($validated);
            $status = 200;
            $message = "បង្កើតលេខកូដសញ្ញាបត្រជោគជ័យ {$request->stu_code}!";
        }

        return response()->json(['status' => $status, 'data' => $message, 'message' => $message]);
    }
    public function generateCode(Request $request)
    {
        $validated = $request->validate([
            'stu_code' => 'required|string|max:50',
            'class_code' => 'required|string|max:50',
        ]);

        $validated['stu_code'] = $request->stu_code;
        $validated['status'] = 0;
        $validated['isCheck'] = 'generateCode';

        $year = substr((string) Carbon::now()->year, -2);
        $lastRecord = CertStudentStatus::whereNotNull('reference_code')
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
        $newReferenceCode = "{$newNumber}/{$year} វ.ជ.ប.ប";
        $validated['off_code'] = $code;
        $validated['reference_code'] = $newReferenceCode;

        $existingRecord = CertStudentStatus::where('stu_code', $request->stu_code)
            ->where('class_code', $request->class_code)
            ->where('status', 0)
            ->first();
        if ($existingRecord) {
            $record = '';
            $status = 404;
            $message = "ទិន្នន័យមានរួចរាល់ {$request->stu_code}!";
        } else {
            $record = CertStudentStatus::create($validated);
            $status = 200;
            $message = "បង្កើតលេខកូដសញ្ញាបត្រជោគជ័យ {$request->stu_code}!";
        }

        return response()->json(['status' => $status, 'data' => $message, 'message' => $message]);
    }
    public function isCheck(Request $request)
    {
        $validated = $request->validate([
            'stu_code' => 'required|string|max:50',
            'class_code' => 'required|string|max:50',
        ]);

        $validated['stu_code'] = $request->stu_code;
        $validated['status'] = 1;
        $validated['isCheck'] = 'print';

        $record_class = Classes::whereNotNull('code')
            ->where('code', $request->class_code ?? 0)
            ->first();

        $existingRecord = CertStudentStatus::where('stu_code', $request->stu_code)
            ->where('class_code', $request->class_code)
            ->whereNotNull('print_date')
            ->first();
        if ($existingRecord) {
            $record = '';
            $status = 404;
            $message = "ទិន្នន័យមានរួចរាល់ {$request->stu_code}!";
        } else {
            $record = CertStudentStatus::updateOrCreate(
                ['stu_code' => $request->stu_code],
                [
                    'print_by' => Auth::id() ?? 0,
                    'print_by_date' => now(),
                    'status' => 1,
                ]
            );
            $status = 200;
            $message = "បង្កើតលេខកូដសញ្ញាបត្រជោគជ័យ {$record->stu_code}!";
        }

        return response()->json(['status' => $status, 'data' => $message, 'message' => $message]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $dept_code = $request->input('dept_code');
        $class_code = $request->input('class_code');
        $qualification = $request->input('qualification');
        $sections_code = $request->input('sections_code');
        $skills_code = $request->input('skills_code');

        $search = $request->input('search');
        $rows_per_page = $request->input('rows_per_page', 50);

        $students = StudentModel::query()
            ->select([
                'student.*',
                'dept.name_2 as dept',
                'cls.name as class',
                'cls.level as level',
                'sk.name_2 as skill',
                DB::raw('(SELECT stu.name_2 FROM sections AS stu WHERE stu.code = cls.sections_code LIMIT 1) as section_type'),
                DB::raw('(SELECT pic.picture_ori FROM picture AS pic WHERE pic.code = student.code ORDER BY pic.id DESC LIMIT 1) as stu_photo'),
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

            $record_print = CertStudentStatus::where('stu_code', $student->code)
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

    public function showPrint(Request $request)
    {
        $key = $request->key;

        $stu_code = secured_decrypt($key);

        $record = CertStudentStatus::where('stu_code', $stu_code)->orderBy('id', 'desc')->first();
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



        $record_print = CertStudentStatus::where('stu_code', $stu_code)
            ->select('print_date')
            ->orderByDesc('id')
            ->first();
        $groupedSubjects = $subjects->groupBy(['years', 'semester']);

        $html = view('certificate.student_status.print', [
            'stu_code'  => $stu_code,
            'record'  => $record ?? [],
            'records_info'  => $records_info,
            'records_transcript'  => $data,
            'records_subjects'  => $groupedSubjects,
            'record_print'  => $record_print,
        ])->render();

        $filePath = storage_path('app/public/print/output.pdf');
        $filename = 'YTM-' . Carbon::now()->format('Y-m-d') . '-' . Str::random(8) . '.pdf';
        Browsershot::html($html)
            ->setChromePath('C:\Users\DEV-404\.cache\puppeteer\chrome\win64-137.0.7151.55\chrome-win64\chrome.exe')
            ->setCustomTempPath(storage_path('app/private/livewire-tmp'))
            ->format('A4')
            ->margins(10, 5, 15, 5)
            ->landscape(false)
            ->showBackground()
            ->savePdf($filePath);
        return response()->stream(function () use ($filePath) {
            readfile($filePath);
            unlink($filePath);
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
        ]);
    }

    public function printMultilple($array)
    {
        $key = explode(',', $array);

        if (empty($key)) {
            abort(400, 'No students selected.');
        }

        $record_students = StudentModel::with(['certStatus', 'assignClassLine.assignClass.level', 'assignClassLine.assignClass.class', 'assignClassLine.assignClass.sessionYear'])
            ->whereIn('code', $key)
            ->get();
        //dd($record_students);
        $html = view('certificate.student_status.print-multilple', [
            'record_students'  => $record_students,
        ])->render();

        $filename = 'NTTI-' . Carbon::now()->format('Y-m-d') . '-' . Str::random(8) . '.pdf';

        $pdf = Browsershot::html($html)
            ->setChromePath(env('SPATIE_BROWSER'))
            ->setCustomTempPath(storage_path(env('SPATIE_TMP')))
            ->format('A4')
            ->margins(10, 5, 15, 5)
            ->landscape(false)
            ->pdf();

        return response($pdf)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename=' . $filename);
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
