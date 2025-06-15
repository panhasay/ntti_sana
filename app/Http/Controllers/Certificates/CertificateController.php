<?php

namespace App\Http\Controllers\Certificates;

use DateTime;
use Exception;
use Carbon\Carbon;
use App\Service\service;
use App\Exports\ExportData;
use App\Models\StudentModel;
use Illuminate\Http\Request;
use App\Models\General\Skills;
use App\Models\General\Classes;
use App\Models\General\Picture;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\General\Sections;
use Illuminate\Support\Facades\DB;
use App\Models\general\SessionYear;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\CertificateSubModule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\General\Qualifications;
use App\Models\SystemSetup\Department;
use Illuminate\Support\Facades\Validator;
use App\Models\Certificates\CertSubModule;

use App\Models\CertificateStudentPrintCard;
use App\Models\Certificates\CertStudentPrintCardSession;
use App\Models\Certificates\CertStudentPrintCardRevision;
use App\Models\Certificates\CertStudentPrintCardExpireClass;
use App\Http\Controllers\certificates\CertificateDegreeController;
use App\Http\Controllers\Certificates\CertificateOfficialTranscriptController;


class CertificateController extends Controller
{
    protected $tranController;
    protected $provisionalController;
    protected $services;
    public $page_id;
    public $page;
    public $prefix;
    public $table_id;
    public $arrayJoin = [];

    public $controllerAction;

    function __construct()
    {
        $this->services = new Service();
        $this->tranController = new CertificateOfficialTranscriptController();
        $this->provisionalController = new CertificateProvisionalController();

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
        $record_dept = Department::where('is_active', 'Yes')->get();

        return view('certificate/certificate_department_menu', compact('record_dept'));
    }

    public function showModuleMenu()
    {
        $record_certificate = CertificateSubModule::where('active', 1)->get();

        return view('certificate/certificate_module_menu', compact('record_certificate'));
    }

    public function StudentCard(Request $request)
    {
        $module_code = $request->module_code;

        $record_dept = Department::where('is_active', 'Yes')->get();
        $record_shift = Sections::where('is_active', 'Yes')->get();
        $arr_module = CertificateSubModule::where('code', $module_code)->get();

        $record_class = Classes::select('code', 'name')
            ->distinct()
            ->get();

        $record_level = Qualifications::whereNotNull('name_3')->get();

        $record_skill = Skills::whereHas('classes')->get();

        $sessionYear = SessionYear::where('is_active', 'yes')
            ->orderBy('code', 'desc')
            ->first();


        return view('certificate/certificate_card_list', compact(
            'record_class',
            'record_dept',
            'record_shift',
            'module_code',
            'arr_module',
            'record_level',
            'record_skill',
            'sessionYear'
        ))->render();
    }
    public function DegreeManagement(Request $request)
    {
        // return $this->degreeController->index($request);
    }
    public function OfficialTranscript(Request $request)
    {
        return $this->tranController->index($request);
    }

    public function permissionCertificate(Request $request)
    {
        return $this->tranController->index($request);
    }

    public function ProvisionalCertificate(Request $request)
    {
        return $this->provisionalController->index($request);
    }

    function getEducationLevelValue($level)
    {
        $levels = [
            'បរិញ្ញាបត្រ' => 5,
            'បរិញ្ញាបត្ររង' => 3,
            'បរិញ្ញាបត្របន្ត' => 3,
            'មធ្យមសិក្សាទីមួយ' => 1
        ];

        return $levels[$level] ?? 0;
    }

    public function showLevelShiftSkill(Request $request)
    {
        $dept_code = $request->input('dept_code');
        $class_code = $request->input('class_code');
        $sch_level = $request->input('sch_level');
        $sch_shift = $request->input('sch_shift');
        $sch_skill = $request->input('sch_skill');

        $query = Classes::whereNotNull('department_code');

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

            $record_card_expire = CertStudentPrintCardExpireClass::where('class_code', $student->class_code)
                ->where('status', 1)
                ->orderBy('session_code', 'desc')
                ->first();

            $now = Carbon::now()->subYear();
            $expireDate = Carbon::parse($record_card_expire['expire_date'] ?? $now);

            $diff = $expireDate->diff($now);

            $student->expire_date = $record_card_expire['expire_date'] ?? 0;
            $student->print_expire_date = $record_card_expire['print_expire_date'] ?? 0;
            $student->remaining = "{$diff->y} years, {$diff->m} months, and {$diff->d} days";
            if ($expireDate <= $now) {
                $student->class_remaining = 'text-danger';
            } else {
                $student->class_remaining = 'text-success';
            }

            $student->expire_formate_date = $this->services::DateYearKH($record_card_expire['expire_date'] ?? '0000-00-00');

            $count_revision = CertStudentPrintCardRevision::where('print_card_id', $student->print_card_id)
                ->where('status', 1)
                ->count();
            $student->count_revision = $count_revision;
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

            $sessionYear = CertStudentPrintCardSession::where('status', 1)
                ->orderBy('session_code', 'desc')
                ->first();
            $validated['print_code'] = $sessionYear['id'] ?? 0;

            $records = StudentModel::getFilteredStudentsOnly($dept_code, $class_code, $stu_code);
            if ($records) {
                $records->print_khmer_date_format = formatDateToKhmer($records->print_khmer_date ?? now(), 'kh');
                $filePath = public_path('uploads/student/' . $records->stu_photo);
                $records->photo_status = $records->stu_photo && file_exists($filePath) ? true : false;
                $records->print_khmer_lunar = $sessionYear['print_khmer_lunar'] ?? null;
                $records->print_date_due = $sessionYear['print_date_due'] ?? null;

                $record_Qualifications = Qualifications::where('code', $records->level)->first();
            }


            $existingRecord = CertificateStudentPrintCard::where('stu_code', $stu_code)->first();
            if ($existingRecord) {
                $existingRecord->update($validated);
                $record_print = $existingRecord;
            } else {
                $record_print = CertificateStudentPrintCard::create($validated);
            }
            $record_date_khmer = self::getKhmerDateCardStudent(now());

            $print_card_id = $record_print->id;
            $column['print_card_id'] = $print_card_id;
            $column['status'] = 1;
            $column['revision'] = 1;
            $check_revision = CertStudentPrintCardRevision::where('print_card_id', $print_card_id)->first();
            if ($check_revision) {
            } else {
                $record_print = CertStudentPrintCardRevision::create($column);
                $status = 200;
                $message = "Add successfully!";
            }

            return view('certificate.certificate_card_print', compact('records', 'record_date_khmer', 'record_print', 'record_Qualifications'));
        } catch (\Exception $e) {
            Log::error('Card print error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to generate student card');
        }
    }
    public function storePrintCardRevision(Request $request)
    {
        try {
            $print_card_id = $request->input('print_card_id');
            $dept_code = $request->input('dept_code');
            $class_code = $request->input('class_code');
            $stu_code = $request->input('stu_code');


            $validated['status'] = 1;
            $validated['revision'] = 1;

            $check_print = CertificateStudentPrintCard::where('stu_code', $stu_code)->where('status', 1)->first();
            $validated['print_card_id'] = $check_print->id;
            if ($check_print) {
                $existingRecord = CertStudentPrintCardRevision::where('print_card_id', $check_print->id)->first();

                if ($existingRecord) {
                    $record_print = CertStudentPrintCardRevision::create($validated);
                    $status = 200;
                    $message = "បន្ថែមបោះពុម្ភកាតសិស្សជោគជ័យ";
                } else {
                    $record_print = CertStudentPrintCardRevision::create($validated);
                    $status = 200;
                    $message = "បន្ថែមបោះពុម្ភកាតសិស្សជោគជ័យ";
                }
            } else {
                $record_print = CertStudentPrintCardRevision::create($validated);
                $status = 200;
                $message = "បន្ថែមបោះពុម្ភកាតសិស្សជោគជ័យ";
            }

            return response()->json(['status' => $status, 'data' => $record_print, 'message' => $message]);
        } catch (\Exception $e) {
            Log::error('Card print error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to generate student card');
        }
    }
    public function printCardStudentPdf111(Request $request)
    {
        $dept_code = $request->query('dept_code');
        $class_code = $request->query('class_code');
        $stu_code = $request->query('stu_code');

        $baseUrl = \App\Http\Controllers\QrCodeController::getBaseUrl()->getData()->base_url;
        $originalUrl = $baseUrl . '/dsa?code=' . urlencode(secured_encrypt($stu_code));

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
            $validated['original_url'] = $originalUrl;
            $validated['short_code'] = substr(md5($originalUrl . now()), 0, 10);
            $record_print = CertificateStudentPrintCard::create($validated);
        }
        $record_date_khmer = $record_print['print_khmer_lunar'] ?? self::getKhmerDateCardStudent(now());

        $data = [
            'records' => $records,
            'record_date_khmer' => $record_date_khmer,
            'record_print' => $record_print,
        ];

        $pdf = Pdf::loadView('certificate.certificate_card_print_pdf', $data)
            ->setPaper([0, 0, 155, 244])
            ->setOption([
                'fontDir' => public_path('/fonts'),
                'fontCache' => public_path('/fonts'),
                'defaultFont' => 'KhmerOSbattambang'
            ]);
        return $pdf->stream('student_card.pdf');
    }
    public function printCardStudentPdf(Request $request)
    {
        $dept_code = $request->query('dept_code');
        $class_code = $request->query('class_code');
        $stu_code = $request->query('stu_code');

        $baseUrl = \App\Http\Controllers\QrCodeController::getBaseUrl()->getData()->base_url;
        $originalUrl = $baseUrl . '/dsa?code=' . urlencode(secured_encrypt($stu_code));

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
            $validated['original_url'] = $originalUrl;
            $validated['short_code'] = substr(md5($originalUrl . now()), 0, 10);
            $record_print = CertificateStudentPrintCard::create($validated);
        }
        $record_date_khmer = $record_print['print_khmer_lunar'] ?? self::getKhmerDateCardStudent(now());

        $data = [
            'records' => $records,
            'record_date_khmer' => $record_date_khmer,
            'record_print' => $record_print,
        ];

        $html = View::make('certificate.certificate_card_print_pdf', $data)->render();
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
        $khmerDayInLunarPhase = self::convertToKhmerNumerals(sprintf('%02d', $dayInLunarPhase));


        $dayOfWeek = $khmerDays[$date->format('w')];

        $month = $LunarNewYear[$date->format('n') - 0];
        $year = $nameYear[(($date->format('Y') - 5) % 12)];

        return "{$dayOfWeek} {$khmerDayInLunarPhase}{$lunarPhase} ខែ{$month} {$year} {$khmerYearCycle} ព.ស. {$buddhistYear}";
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

            $record_card_expire = CertStudentPrintCardExpireClass::where('class_code', $students->class_code)
                ->where('status', 1)
                ->orderBy('session_code', 'desc')
                ->first();

            $now = Carbon::now()->subYear();
            $expireDate = Carbon::parse($record_card_expire['expire_date'] ?? $now);

            $diff = $expireDate->diff($now);

            $students->expire_date = $record_card_expire['expire_date'] ?? 0;
            $students->print_expire_date = $record_card_expire['print_expire_date'] ?? 0;
            $students->remaining = "{$diff->y} years, {$diff->m} months, and {$diff->d} days";
            if ($expireDate <= $now) {
                $students->class_remaining = 'text-danger';
            } else {
                $students->class_remaining = 'text-success';
            }
        }

        return response()->json($students);
    }
    public function updateCardInformation(Request $request)
    {
        try {
            $validated = $request->validate([
                'stu_code' => 'required|max:50',
                'class_code' => 'required|string|max:50',
                'photo' => 'required|image|max:5120', // 5MB
            ], [
                'photo.max' => 'រូបភាពមិនអាចធំជាង 5MB បានទេ។',
                'photo.image' => 'ឯកសារដែលផ្ដល់មិនមែនជា​រូបភាព។',
            ]);

            $validated['status'] = 1;
            $validated['update_by'] = Auth::id();
            $validated['update_by_date'] = now();

            $stu_code = $request->input('stu_code');
            $photo = $request->file('photo');
            $date = now()->format('Ymd');
            $fileName = 'ntti_' . $stu_code . '_' . $date . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $filePath = 'uploads/student/' . $fileName;

            $photo->move(public_path('uploads/student'), $fileName);

            $existingPhoto = Picture::where('code', $stu_code)->first();
            if ($existingPhoto) {
                $uploadPath = public_path('uploads/student/');
                if (!empty($existingPhoto->picture_ori)) {
                    $oldFilePath = $uploadPath . $existingPhoto->picture_ori;
                    if (File::exists($oldFilePath)) {
                        File::delete($oldFilePath);
                    }
                }

                $existingPhoto->update([
                    'picture_ori' => $fileName,
                ]);
                $message = 'កែប្រែរូបថតជោគជ័យ';
            } else {
                Picture::create([
                    'code' => $stu_code,
                    'picture_ori' => $fileName,
                ]);
                $message = 'កែប្រែរូបថតជោគជ័យ';
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'filePath' => $filePath ?? null,
            ]);
        } catch (Exception $e) {
            Log::error('Update photo error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'មានបញ្ហាក្នុងការផ្ទុករូបភាព។ សូមព្យាយាមម្ដងទៀត។',
            ], 500);
        }
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

            $print_card_id = $existingRecord->id;

            $check_revision = CertStudentPrintCardRevision::where('print_card_id', $print_card_id)
                ->orderBy('id', 'desc')
                ->first();
            if ($check_revision) {
                $check_revision->delete();
            }
            $success = true;
            $message = 'ដកបោះពុម្ពកាតសិស្សជោគជ័យ';
        } else {
            $success = false;
            $message = 'ទិន្នន័យមិនមានសម្រាប់ដកបោះពុម្ព';
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
        $type = $request->input('type');
        $dept_code = $request->input('dept_code');
        $imageSources = $request->input('imageSources');

        if ($type == 'zip') {
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

                    $check_stu_code = StudentModel::where('code', $stu_code)->first();

                    $uploadPath = public_path('uploads/student/');
                    $filePath = public_path('uploads/student/' . $newFileName);

                    if ($check_stu_code) {
                        $exists = Picture::where('code', $stu_code)->count();
                        if ($exists > 0) {
                            // Remove old image if exists before saving new one
                            if (!empty($student->picture_ori)) {
                                $oldFilePath = $uploadPath . $student->picture_ori;
                                if (File::exists($oldFilePath)) {
                                    File::delete($oldFilePath);
                                }
                            }

                            file_put_contents($filePath, $fileContent);
                            $student->picture_ori = $newFileName;
                            $student->save();

                            $updatedStudents[] = $newFileName;
                        } else {
                            $picture = Picture::create([
                                'code' => $stu_code,
                                'type' => 'student',
                                'picture_ori' => $newFileName,
                            ]);

                            $filePath = $uploadPath . $newFileName;
                            file_put_contents($filePath, $fileContent);

                            $updatedStudents[] = $newFileName;
                        }
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
        } else {
            if ($request->has('imageSources')) {
                $imageSourcesArr = $request->input('imageSources');
                $fileNameArr = $request->input('fileNames');

                $updatedStudents = [];

                foreach ($imageSourcesArr as $key => $imageData) {
                    $defaultFileName = pathinfo($fileNameArr[$key], PATHINFO_FILENAME);

                    $check_stu_code = StudentModel::where('code', $defaultFileName)->first();
                    if ($check_stu_code) {
                        $imageParts = explode(";base64,", $imageData);
                        $imageTypeAux = explode("image/", $imageParts[0]);
                        $imageType = $imageTypeAux[1];
                        $imageBase64 = base64_decode($imageParts[1]);


                        $date = now()->format('Ymd');
                        $newFileName = 'ntti_' . $defaultFileName . '_' . $date . '_' . uniqid() . '.' . $imageType;

                        $student = Picture::where('code', $defaultFileName)->first();
                        $exists = Picture::where('code', $defaultFileName)->count();

                        $uploadPath = public_path('uploads/student/');

                        if ($exists > 0) {

                            if (!File::exists($uploadPath)) {
                                File::makeDirectory($uploadPath, 0755, true);
                            }

                            if (!empty($student->picture_ori)) {
                                $oldFilePath = $uploadPath . $student->picture_ori;
                                if (File::exists($oldFilePath)) {
                                    File::delete($oldFilePath);
                                }
                            }



                            $filePath = $uploadPath . $newFileName;
                            file_put_contents($filePath, $imageBase64);

                            $student->picture_ori = $newFileName;
                            $student->save();

                            $updatedStudents[] = $newFileName;
                        } else {
                            $picture = Picture::create([
                                'code' => $defaultFileName,
                                'type' => 'student',
                                'picture_ori' => $newFileName,
                            ]);

                            $filePath = $uploadPath . $newFileName;
                            file_put_contents($filePath, $imageBase64);

                            $updatedStudents[] = $newFileName;
                        }
                    }
                }

                return response()->json([
                    'status' => 200,
                    'message' => 'ផ្ទុករូបថតជោគជ័យ',
                    'updatedStudents' => $updatedStudents,
                ]);
            }

            return response()->json([
                'status' => 400,
                'message' => 'សូមជ្រើសរើសរូបថត',
            ]);
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
    public function StoreDueDateSession(Request $request)
    {
        $validated = $request->validate([
            'session_code' => 'required|max:50'
        ]);
        $validated['print_date'] =  $request->input('print_date');
        $validated['status'] = 1;
        $validated['create_by'] = Auth::id();
        $validated['create_by_date'] = now();
        $validated['print_khmer_lunar'] =  $request->input('print_khmer_lunar');
        $validated['print_date_due'] =  $request->input('print_date_due');
        $validated['print_expire_date'] =  $request->input('print_expire_date');

        $existingRecord = CertStudentPrintCardSession::where('session_code', $request->input('session_code'))
            ->where('status', 1)
            ->first();
        if ($existingRecord) {
            $record_print = $existingRecord;
            $status = 404;
            $message = 'ទិន្នន័យមានរួចហើយ';
        } else {
            $record_print = CertStudentPrintCardSession::create($validated);
            $status = 200;
            $message = 'ធ្វើថ្ងៃកាលបរិច្ឆទបោះពុម្ភកាតសិស្សដោយជោគជ័យ';
        }

        return response()->json(['status' => $status, 'data' => $record_print, 'message' => $message]);
    }
    public function UpdateDueDateSession(Request $request)
    {
        $validated = $request->validate([
            'session_code' => 'required|max:50'
        ]);
        $validated['print_date'] =  $request->input('print_date');
        $validated['status'] = 1;
        $validated['create_by'] = Auth::id();
        $validated['create_by_date'] = now();
        $validated['print_khmer_lunar'] =  $request->input('print_khmer_lunar');
        $validated['print_date_due'] =  $request->input('print_date_due');
        $validated['print_expire_date'] =  $request->input('print_expire_date');

        $existingRecord = CertStudentPrintCardSession::where('session_code', $request->input('session_code'))
            ->where('status', 1)
            ->first();
        if ($existingRecord) {
            $existingRecord->update($validated);
            $record_print = $existingRecord;
            $status = 200;
            $message = 'ធ្វើកែប្រែថ្ងៃកាលបរិច្ឆទបោះពុម្ភកាតសិស្សដោយជោគជ័យ';
        } else {
            $status = 404;
            $record_print = null;
            $message = 'រកមិនឃើញទិន្ន័យ';
        }

        return response()->json(['status' => $status, 'data' => $record_print, 'message' => $message]);
    }
    public function showDatePrintCardSession(Request $request)
    {
        $session_code = $request->input('session_code');

        $existingRecord = CertStudentPrintCardSession::where('session_code', $session_code)
            ->where('status', 1)
            ->first();

        if ($existingRecord) {
            return response()->json([
                'status' => 200,
                'data' => $existingRecord,
                'message' => 'Record found successfully!',
            ]);
        }

        return response()->json([
            'status' => 404,
            'data' => null,
            'message' => 'Record not found!',
        ]);
    }
    public function showCardTotalStudent(Request $request)
    {
        $dept_code = $request->input('dept_code');
        $class_code = $request->input('class_code');

        $students = StudentModel::getShowCardTotalStudent($dept_code, $class_code);
        return response()->json($students);
    }
    public function StoreDueDateExpireSession(Request $request)
    {
        $validated = $request->validate([
            'session_code' => 'required|max:50'
        ]);

        $session_code = $request->input('session_code');
        $level = $request->input('level');
        $class_code = $request->input('class_code');
        $year = $request->input('year');
        $expire_date = $request->input('expire_date');
        $print_expire_date = $request->input('print_expire_date');

        $query = Classes::whereNotNull('department_code');
        if (!empty($level)) {
            $query->where('level', $level);
        }
        if ($class_code != 'code_all') {
            $query->where('code', $class_code);
        }
        $record_level = $query->get();

        foreach ($record_level as $class) {
            $validated = [
                'session_code' => $session_code,
                'class_code' => $class->code,
                'year' => $year,
                'expire_date' => $expire_date,
                'print_expire_date' => $print_expire_date,
                'status' => 1,
            ];

            $existingRecord = CertStudentPrintCardExpireClass::where('session_code', $session_code)
                ->where('class_code', $class->code)
                ->where('status', 1)
                ->first();

            if ($existingRecord) {
                $status = 404;
                $message = "ទិន្នន័យមានរួចហើយ";
            } else {
                CertStudentPrintCardExpireClass::create($validated);
                $status = 200;
                $message = "បង្កើតកាលបរិច្ឆេទផុតកំណត់ជោគជ័យ";
            }
        }

        return response()->json(['status' => $status, 'data' => $message, 'message' => $message]);
    }
    public function updateDueDateExpireSession(Request $request)
    {
        $validated = $request->validate([
            'session_code' => 'required|max:50'
        ]);

        $session_code = $request->input('session_code');
        $level = $request->input('level');
        $class_code = $request->input('class_code');
        $expire_date = $request->input('expire_date');
        $print_expire_date = $request->input('print_expire_date');

        $query = Classes::whereNotNull('department_code');
        if (!empty($level)) {
            $query->where('level', $level);
        }
        if ($class_code != 'code_all') {
            $query->where('code', $class_code);
        }
        $record_level = $query->get();

        $status = '';

        foreach ($record_level as $class) {
            $validated = [
                'session_code' => $session_code,
                'class_code' => $class->code,
                'expire_date' => $expire_date,
                'print_expire_date' => $print_expire_date,
                'update_by' => Auth::id() ?? 0,
                'update_by_date' => now(),
                'status' => 1,
            ];

            $existingRecord = CertStudentPrintCardExpireClass::where('session_code', $session_code)
                ->where('class_code', $class->code)
                ->where('status', 1)
                ->first();

            if ($existingRecord) {
                $existingRecord->update($validated);
                $status = 200;
                $message = "កែប្រែកាលបរិច្ឆេទផុតកំណត់ជោគជ័យ";
            } else {
                $status = 404;
                $message = "ទិន្នន័យមិនមានសម្រាប់កែប្រែ";
            }
        }

        return response()->json(['status' => $status, 'data' => $message, 'message' => $message]);
    }

    public function showCardExpireLevel(Request $request)
    {
        $level = $request->input('level');
        $year = $request->input('year');

        $query = Classes::whereNotNull('department_code');

        $query->where('level', $level ?? '');

        $record_level = $query->select('*')
            ->get();

        $exp_yaer = $this->getEducationLevelValue($level) - $year;
        $newDate = Carbon::now()->addYears($exp_yaer)->format('Y-m-d');
        return response()->json(array(
            'record_level' => $record_level,
            'record_date' => $newDate,
            'record_exp_year' => self::getKhmerDateCardStudent(new DateTime($newDate)),
        ));
    }

    public function printListClassification(Request $request)
    {
        $data = $request->all();
        $class_code = $data['class_code'];
        try {
            $records = StudentModel::where('class_code', $data['class_code'])->orderByRaw("name_2 COLLATE utf8mb4_general_ci")->get();
            $header = Classes::where('code', $class_code)->first();
            return view('certificate.student_lists_card', compact('records', 'header'));
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }

    public function ExcelListClassification(Request $request)
    {
        try {
            $filter = $request->all();


            $extract_query = $this->services->extractQuery($filter);
            $header = Classes::where('code', $filter['class_code'])->first();
            $code_class = $filter['class_code'];

            $type = "downlaodexcel";

            $excel_name = $code_class . '_class.xlsx';
            // Fetch student records with relationships to avoid N+1 queries
            $records = StudentModel::where('class_code', $filter['class_code'])
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
            // $this->services->telegram($ex->getMessage(), 'list of student', $ex->getLine());
            return response()->json(['status' => 'warning', 'msg' => $ex->getMessage()]);
        }
    }

    public function showExpireClass111(Request $request)
    {
        $level_code = $request->input('level_code');
        $class_code = $request->input('class_code');

        $query = CertStudentPrintCardExpireClass::where('status', 1);
        if ($class_code !== 'code_all') {
            $query->where('class_code', $class_code);
        }
        $query->whereHas('class', function ($q) use ($level_code) {
            $q->where('level', $level_code);
        });
        $results = $query->with(['class', 'createdBy:id,name', 'updatedBy:id,name'])->get();
        return response()->json($results);
    }
    public function showExpireClass(Request $request)
    {
        $level_code = $request->input('level_code');
        $class_code = $request->input('class_code');

        $query = CertStudentPrintCardExpireClass::where('status', 1);

        if ($class_code !== 'code_all') {
            $query->where('class_code', $class_code);
        }

        $query->whereHas('class', function ($q) use ($level_code) {
            $q->whereHas('qualification', function ($q2) use ($level_code) {
                $q2->where('code', $level_code);
            });
        });

        $results = $query->with(['class.qualification', 'createdBy:id,name', 'updatedBy:id,name'])->get();

        return response()->json($results);
    }
}
