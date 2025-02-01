<?php

namespace App\Http\Controllers\Certificates;

use App\Exports\ExportData;
use DateTime;
use ZipArchive;
use Carbon\Carbon;
use App\Models\StudentModel;
use Illuminate\Http\Request;
use App\Models\General\Skills;
use App\Models\General\Classes;
use App\Models\General\Picture;
use App\Models\General\Sections;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\CertificateSubModule;
use Illuminate\Support\Facades\Auth;
use App\Models\SystemSetup\Department;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\CertificateStudentPrintCard;
// use App\Http\Controllers\certificates\CertificatePdfController;
// use App\Http\Controllers\certificates\CertificateStudentPrintCardController;
use App\Models\General\Qualifications;
use App\Models\Student\Student;
use App\Service\service;
use Maatwebsite\Excel\Facades\Excel;

class CertificateController extends Controller
{
    public $services;
    public $page_id;
    public $page;
    public $prefix;
    public $table_id;
    public $arrayJoin = [];

    function __construct()
    {
        $this->services = new service();
        $this->page_id = "10001";
        $this->page = "certificate";
        $this->prefix = "certificate";
        $this->arrayJoin = ['10001', '10007', '10008'];
        $this->table_id = "10005";
    }
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $record_dept = Department::where('is_active', 'Yes')->take('3')->get();

        return view('certificate/certificate_department_menu', compact('record_dept'));
    }
    /**
     * showMenuModule
     *
     * @param  mixed $dept_code
     * @return void
     */
    public function showMenuModule($dept_code)
    {
        $record_certificate = CertificateSubModule::where('active', 1)->take('3')->get();
        $record_dept = Department::where('code', $dept_code)->get();

        return view('certificate/certificate_module_menu', compact('record_certificate', 'dept_code', 'record_dept'));
    }

    public function StudentCard(Request $request)
    {
        $dept_code = $request->dept_code;
        $module_code = $request->module_code;

        $record_dept = Department::where('is_active', 'Yes')->get();
        $record_shift = Sections::where('is_active', 'Yes')->get();
        $arr_dept = Department::where('code', $dept_code)->get();
        $arr_module = CertificateSubModule::where('code', $module_code)->get();

        $record_class = Classes::where('department_code', $dept_code ?? '')
            ->select('code', 'name')
            ->distinct()
            ->get();

        $record_level = Classes::where('department_code', $dept_code ?? '')
            ->select('level')
            ->distinct('level')
            ->get();

        $record_skill = Skills::whereHas('classes', function ($query) use ($dept_code) {
            $query->where('department_code', $dept_code);
        })->distinct()->get();

        return view('certificate/certificate_card_list', compact('record_class', 'record_dept', 'record_shift', 'dept_code', 'module_code', 'arr_dept', 'arr_module', 'record_level', 'record_skill'));
    }

    public function showLevelShiftSkill(Request $request)
    {
        $dept_code = $request->input('dept_code');
        $class_code = $request->input('class_code');
        $sch_level = $request->input('sch_level');
        $sch_shift = $request->input('sch_shift');
        $sch_skill = $request->input('sch_skill');

        $query = Classes::where('department_code', $dept_code ?? '');

        $query->where('code', $class_code ?? '');
        if (!empty($sch_level)) {
            $query->where('level', $sch_level);
        }
        if (!empty($sch_shift)) {
            $query->where('sections_code', $sch_shift);
        }
        if (!empty($sch_skill)) {
            $query->where('skills_code', $sch_skill);
        }

        $record_level = $query->select('*')
            ->distinct('level')
            ->get();

        return response()->json(array(
            'record_level' => $record_level,
        ));
    }
    public function showCardView(Request $request)
    {
        $dept_code = $request->input('dept_code');
        $class_code = $request->input('class_code');
        $search = $request->input('search');
        $page = $request->input('page', 1);
        $rows_per_page = $request->input('rows_per_page', 50);

        $students = StudentModel::getFilteredStudents($dept_code, $class_code, $search, $rows_per_page);
        $students->transform(function ($student) {
            $student->stu_photo = DB::table('picture')
                ->where('code', $student->code)
                ->orderByDesc('id')
                ->value('picture_ori');

            $filePath = public_path('uploads/student/' . $student->stu_photo);

            $student->photo_status = $student->stu_photo && file_exists($filePath) ? true : false;
            return $student;
        });
        return response()->json([
            'data' => $students->items(),
            'current_page' => $students->currentPage(),
            'last_page' => $students->lastPage(),
            'page' => $students->perPage(),
            'links' => $students->links('pagination::pagination-synoeun')->toHtml(),
        ]);
    }
    public function printCardStudent(Request $request)
    {
        try {
            $dept_code = $request->input('dept_code');
            $class_code = $request->input('class_code');
            $stu_code = $request->input('stu_code');

            $validated = $request->validate([
                'stu_code' => 'required|max:50',
                'class_code' => 'required|string|max:50',
            ]);
            $validated['status'] = 1;
            $validated['print_by'] = Auth::id();
            $validated['print_by_date'] = now();

            $records = StudentModel::getFilteredStudentsOnly($dept_code, $class_code, $stu_code);
            if ($records) {
                $records->print_khmer_date_format = formatDateToKhmer($records->print_khmer_date ?? now(), 'kh');
                $filePath = public_path('uploads/student/' . $records->stu_photo);
                $records->photo_status = $records->stu_photo && file_exists($filePath) ? true : false;
            }

            $existingRecord = CertificateStudentPrintCard::where('stu_code', $stu_code)->first();
            if ($existingRecord) {
                $existingRecord->update($validated);
                $record_print = $existingRecord;
            } else {
                $validated['print_khmer_lunar'] = self::getKhmerDateCardStudent(now());
                $validated['print_date'] = now();
                $record_print = CertificateStudentPrintCard::create($validated);
            }
            $record_date_khmer = $record_print['print_khmer_lunar'] ?? self::getKhmerDateCardStudent(now());


            // return view('certificate.certificate_card_print', reder('records', 'record_date_khmer', 'record_print'));

            // response( )

            $view = view('certificate.certificate_card_print', [
                'records' => $records,
                'record_date_khmer' => $record_date_khmer,
                'record_print' => $record_date_khmer,
            ])->render();
        
            // Return the view string as a JSON response
            return response()->json(['view' => $view]);

        } catch (\Exception $e) {
            Log::error('Card print error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to generate student card');
        }
    }
    public function printCardStudentPdf(Request $request)
    {
        return $this->pdf->generatePdf();
    }

    private static function getKhmerYearCycle($buddhistYear)
    {
        $khmerYearCycles = [
            1 => "ឯកស័ក",
            2 => "ទោស័ក",
            3 => "ត្រីស័ក",
            4 => "ចត្វាស័ក",
            5 => "បញ្ចស័ក",
            6 => "ឆស័ក",
            7 => "សប្តស័ក",
            8 => "អដ្ឋស័ក",
            9 => "នព្វស័ក",
            0 => "សំរិទ្ធិស័ក"
        ];
        $cycleIndex = 6;

        return $khmerYearCycles[$cycleIndex];
    }

    private static function convertToKhmerNumerals($number)
    {
        $khmerNumerals = ['០', '១', '២', '៣', '៤', '៥', '៦', '៧', '៨', '៩', '១០', '១១', '១២', '១៣', '១៤', '១៥'];
        $khmerNumber = '';
        foreach (str_split($number) as $digit) {
            $khmerNumber .= $khmerNumerals[$digit];
        }
        return $khmerNumber;
    }
    public static function getKhmerDateCardStudent($date)
    {
        $khmerDays = ["ថ្ងៃអាទិត្យ", "ថ្ងៃចន្ទ", "ថ្ងៃអង្គារ", "ថ្ងៃពុធ", "ថ្ងៃព្រហស្បតិ៍", "ថ្ងៃសុក្រ", "ថ្ងៃសៅរ៍"];
        $LunarNewYear = ["មិគសិរ", "បុស្ស", "មាឃ", "ផល្គុន", "ចេត្រ", "ពិសាខ", "ជេស្ឋ", "អាសាឍ", "ស្រាពណ៏", "ភទ្របទ", "អស្សុជ", "កត្កិក"];
        $khmerMonths = ["មករា", "កុម្ភៈ", "មិនា", "មេសា", "ឧសភា", "មិថុនា", "កក្កដា", "សីហា", "កញ្ញា", "តុលា", "វិច្ឆិកា", "ធ្នូ"];
        $nameYear = ["ឆ្នាំជូត", "ឆ្នាំឆ្លួរ", "ឆ្នាំខាល", "ឆ្នាំថោះ", "ឆ្នាំរោង", "ឆ្នាំម្សាញ់", "ឆ្នាំមមី", "ឆ្នាំមមែ", "ឆ្នាំវក", "ឆ្នាំរកា", "ឆ្នាំច", "ឆ្នាំកុរ"];

        $buddhistYear = self::convertToKhmerNumerals((int) $date->format('Y') + 543);

        $khmerYearCycle = self::getKhmerYearCycle((int) $date->format('Y') + 543);

        $referenceDate = new DateTime('2024-01-07');
        $interval = $date->diff($referenceDate);

        $referenceDate = Carbon::create(2024, 1, 7);
        $daysDiff = $referenceDate->diffInDays($date);
        $lunarMonthIndex = floor(($daysDiff % 360) / 30);
        $lunarDay = ($daysDiff % 30) + 3;

        $lunarPhase = $lunarDay <= 15 ? 'កើត' : 'រោច';
        $dayInLunarPhase = $lunarDay <= 15 ? $lunarDay : $lunarDay - 15;
        $khmerDayInLunarPhase = self::convertToKhmerNumerals($dayInLunarPhase);

        $dayOfWeek = $khmerDays[$date->format('w')];

        $month = $LunarNewYear[$date->format('n') - 0];
        $year = $nameYear[(($date->format('Y') - 5) % 12)];

        return "{$dayOfWeek}{$khmerDayInLunarPhase}{$lunarPhase}ខែ{$month} {$year} {$khmerYearCycle} ព.ស.{$buddhistYear}";
    }

    public function showViewCardInformation(Request $request)
    {
        $dept_code = $request->input('dept_code');
        $class_code = $request->input('class_code');
        $stu_code = $request->input('stu_code');

        $students = StudentModel::getFilteredStudentsOnly($dept_code, $class_code, $stu_code);
        if ($students) {
            $students->print_khmer_date_format = formatDateToKhmer($students->print_khmer_date ?? now(), 'kh');
            $filePath = public_path('uploads/student/' . $students->stu_photo);
            $students->photo_status = $students->stu_photo && file_exists($filePath) ? true : false;
        }

        return response()->json($students);
    }
    public function updateCardInformation(Request $request)
    {
        $validated = $request->validate([
            'stu_code' => 'required|max:50',
            'class_code' => 'required|string|max:50'
        ]);
        $validated['status'] = 1;
        $validated['update_by'] = Auth::id();
        $validated['update_by_date'] = now();
        $validated['print_khmer_lunar'] =  $request->input('khmer_lunar');
        $validated['print_date'] =  $request->input('date');

        $dept_code = $request->input('dept_code');
        $class_code = $request->input('class_code');
        $stu_code = $request->input('stu_code');

        if ($request->file('photo') != null) {
            $validator = Validator::make($request->all(), [
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors(),
                ], 200);
            }

            $photo = $request->file('photo');
            $date = now()->format('Ymd');
            $fileName = 'ntti_' . $stu_code . '_' . $date . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $filePath = 'uploads/student/' . $fileName;

            $photo->move(public_path('uploads/student'), $fileName);
            $existingPhoto = Picture::where('code', $stu_code)->first();
            
            if ($existingPhoto && $existingPhoto->picture_ori != $fileName) {
                $oldPhotoPath = public_path('uploads/student/' . $existingPhoto->picture_ori);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath); // Deletes the old file
                }
            }

            if ($existingPhoto) {
                $existingPhoto->update([
                    'picture_ori' => $fileName,
                ]);
                $message = 'Photo updated successfully!';
            } else {
                Picture::create([
                    'code' => $stu_code,
                    'picture_ori' => $fileName,
                ]);
                $message = 'Photo uploaded successfully!';
            }
        }


        $existingRecord = CertificateStudentPrintCard::where('stu_code', $stu_code)->first();
        if ($existingRecord) {
            $existingRecord->update($validated);
            $record_print = $existingRecord;
            $message = 'Updated successfully!';
        } else {
            $record_print = CertificateStudentPrintCard::create($validated);
            $message = 'Add New successfully!';
        }

        return response()->json(['success' => true, 'message' => $message, 'filePath' => $filePath ?? null]);
    }
    public function disableCardInformation(Request $request)
    {
        $dept_code = $request->input('dept_code');
        $class_code = $request->input('class_code');
        $stu_code = $request->input('stu_code');

        $validated['dept_code'] = $dept_code;
        $validated['class_code'] = $class_code;
        $validated['stu_code'] = $stu_code;

        $validated['status'] = 0;
        $validated['disable_by'] = Auth::id();
        $validated['disable_by_date'] = now();

        $existingRecord = CertificateStudentPrintCard::where('stu_code', $stu_code)->where('status', 1)->first();
        if ($existingRecord) {
            $existingRecord->update($validated);
            $success = true;
            $message = 'Disable successfully!';
        } else {
            $success = false;
            $message = 'Disable Already successfully!';
        }

        return response()->json(['success' => $success, 'message' => $message]);
    }
    public function showChangeDatePrintCard(Request $request)
    {
        $out = [];
        $date = $request->input('date');
        $date = new DateTime($request->input('date') ?? now());

        $out['date_lunar'] = self::getKhmerDateCardStudent($date);
        $out['date_khmer'] = formatDateToKhmer($date ?? now(), 'kh');

        return response()->json($out);
    }

    public function uploadZip(Request $request)
    {
        $dept_code = $request->input('dept_code');
        $request->validate([
            'zipFile' => 'required|file|mimes:zip|max:20480',
        ]);
        $zip = new \ZipArchive;
        $zipFile = $request->file('zipFile');

        if ($zip->open($zipFile->getRealPath()) === TRUE) {
            $updatedStudents = [];

            for ($i = 0; $i < $zip->numFiles; $i++) {
                $fileName = $zip->getNameIndex($i);

                if (!preg_match('/\.(jpg|jpeg|png)$/i', $fileName)) {
                    continue;
                }

                $fileContent = $zip->getFromIndex($i);
                $stu_code = pathinfo($fileName, PATHINFO_FILENAME);
                $extension = pathinfo($fileName, PATHINFO_EXTENSION);

                $date = now()->format('Ymd');
                $newFileName = 'ntti_' . $stu_code . '_' . $date . '_' . uniqid() . '.' . $extension;

                $student = Picture::where('code', $stu_code)->first();

                if ($student) {
                    $filePath = public_path('uploads/student/' . $newFileName);
                    file_put_contents($filePath, $fileContent);

                    $student->picture_ori = $newFileName;
                    $student->save();

                    $updatedStudents[] = $newFileName;
                }
            }

            $zip->close();

            return response()->json([
                'status' => 200,
                'message' => 'ZIP processed successfully.',
                'updatedStudents' => $updatedStudents,
            ]);
        } else {
            return response()->json(['message' => 'Failed to open ZIP file.'], 200);
        }
    }

    public function uploadMultiplePhoto(Request $request)
    {
        $images = $request->input('images');
        if (!is_array($images) || empty($images)) {
            return response()->json(['message' => 'No images provided.'], 400);
        }

        foreach ($images as $imageData) {
        }
    }

    public function printListClassification(Request $request)
    {
        $data = $request->all();
        $class_code = $data['class_code'];
        try {
            $records = Student::where('class_code', $data['class_code'])->orderByRaw("name_2 COLLATE utf8mb4_general_ci")->get();
            $header = Classes::where('code', $class_code)->first();
            return view('certificate.student_lists_card', compact('records', 'header'));
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->services->telegram($ex->getMessage(), 'Print List Student', $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
    public function ExcelListClassification (Request $request)
    {
        try {
            $filter = $request->all();


            $extract_query = $this->services->extractQuery($filter);
            $header = Classes::where('code', $filter['class_code'])->first();
            $code_class = $filter['class_code'];

            $excel_name = $code_class . '_class.xlsx';
            // Fetch student records with relationships to avoid N+1 queries
            $records = Student::where('class_code', $filter['class_code'])
                ->where('study_type', 'new student')->orderByRaw("name_2 COLLATE utf8mb4_general_ci")
                ->get()
                ->map(function ($record) {
                    $record->skills = DB::table('skills')->where('code', $record->skills_code)->value('name_2');
                    $record->classes = DB::table('classes')->where('code', $record->class_code)->value('name');
                    $record->section = DB::table('sections')->where('code', $record->sections_code)->value('name_2');
                    $record->gender = $record->gender;
                    $record->department = DB::table('department')->where('code', $record->department_code)->value('name_2');
                    $record->khmerDate = $this->services->DateFormartKhmer($record->date_of_birth);
                    $record->year_student = $this->services->calculateDateDifference($record->posting_date);
                    $record->picture = Picture::where('code', $record->code)
                        ->where('type', 'student')
                        ->value('picture_ori');
                    return $record;
                });

            // Optimize header-related queries
            $department = optional(Department::where('code', $header->department_code)->first())->name_2;
            $skills = optional(Skills::where('code', $header->skills_code)->first())->name_2;
            $sections = optional(Sections::where('code', $header->sections_code)->first())->name_2;
            $qualification = optional(Qualifications::where('code', $header->level)->first())->name_2;
            $blade_download = "certificate.student_lists_card_excel";
            // Export data to Excel
            return Excel::download(new ExportData($records, $blade_download, $department, $sections, $skills, $qualification, $header), $excel_name);
        } catch (\Exception $ex) {
            $this->services->telegram($ex->getMessage(), 'list of student', $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }
}
