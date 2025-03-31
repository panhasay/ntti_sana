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
use App\Models\general\SessionYear as GeneralSessionYear;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\CertificateSubModule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use App\Models\SystemSetup\Department;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\CertificateStudentPrintCard;
use App\Models\Certificates\CertStudentPrintCardSession;
use App\Models\Certificates\CertStudentPrintCardRevision;
use App\Models\Certificates\CertStudentPrintCardExpireClass;
use App\Http\Controllers\certificates\CertificateDegreeController;
use App\Http\Controllers\Certificates\CertificateOfficialTranscriptController;

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
        $this->services = new Service();
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

        $sessionYear =  DB::table('session_year')->where('is_active', 'yes')
            ->orderBy('code', 'desc')
            ->first();



        return view('certificate/certificate_card_list', compact(
            'record_class',
            'record_dept',
            'record_shift',
            'dept_code',
            'module_code',
            'arr_dept',
            'arr_module',
            'record_level',
            'record_skill',
            'sessionYear'
        ));
    }
    public function DegreeManagement(Request $request)
    {
        //return $this->degreeController->index($request);
    }
    public function OfficialTranscript(Request $request)
    {
        //return $this->tranController->index($request);
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
            
            $student->stu_photo = DB::table('picture')->where('code', $student->code)->orderByDesc('id')->value('picture_ori');

            $filePath = public_path('uploads/student/' . $student->stu_photo);

            $student->photo_status = $student->stu_photo && file_exists($filePath) ? true : false;

            $record_card_expire = CertStudentPrintCardExpireClass::where('class_code', $student->class_code)
                        ->where('status', 1)
                        ->orderBy('session_code', 'desc')
                        ->first();

            $now = Carbon::now()->subYear();

            $expireDate = $this->services::DateYearKH($record_card_expire['expire_date']);

            Carbon::parse($record_card_expire['expire_date'] ?? $now);

            $student->expire_date = $record_card_expire['expire_date'] ?? 0;

            $student->print_expire_date = $record_card_expire['print_expire_date'] ?? 0;
            $student->remaining = $expireDate;

            if ($expireDate <= $now) {
                $student->class_remaining = 'text-danger';
            } else {
                $student->class_remaining = 'text-danger';
            }

            $count_revision = CertStudentPrintCardRevision::where('print_card_id', $student->id)
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
            'links' => $students->links('pagination::pagination-synoeun')->toHtml(),
        ]);
    }
    public function printCardStudent(Request $request)
    {
        try {
            $print_card_id = $request->input('print_card_id');
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
            }


            $existingRecord = CertificateStudentPrintCard::where('stu_code', $stu_code)->first();
            if ($existingRecord) {
                $existingRecord->update($validated);
                $record_print = $existingRecord;
            } else {
                $record_print = CertificateStudentPrintCard::create($validated);
            }
            $record_date_khmer = self::getKhmerDateCardStudent(now());

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

            return view('certificate.certificate_card_print', compact('records', 'record_date_khmer', 'record_print'));
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

            $validated['print_card_id'] = $print_card_id;
            $validated['status'] = 1;
            $validated['revision'] = 1;

            $existingRecord = CertStudentPrintCardRevision::where('print_card_id', $print_card_id)->first();


            $check_print = CertificateStudentPrintCard::where('stu_code', $stu_code)->where('status', 1)->first();
            if ($check_print) {
            } else {
            }

            if ($existingRecord) {
                $record_print = CertStudentPrintCardRevision::create($validated);
                $status = 200;
                $message = "Add successfully!";
            } else {
                $record_print = CertStudentPrintCardRevision::create($validated);
                $status = 200;
                $message = "Add successfully!";
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

        // $pdf = Pdf::loadView('certificate.certificate_card_print_pdf', $data)
        //     ->setPaper([0, 0, 155, 244])
        //     ->setOption([
        //         'fontDir' => public_path('/fonts'),
        //         'fontCache' => public_path('/fonts'),
        //         'defaultFont' => 'KhmerOSbattambang'
        //     ]);
        // return $pdf->stream('student_card.pdf');
    }
    public function printCardStudentPdf(Request $request)
    {
        //return $this->pdf->generatePdf();
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
        // $dayInLunarPhase = $lunarDay <= 15 ? $lunarDay : $lunarDay - 15;
        // // $khmerDayInLunarPhase = self::convertToKhmerNumerals($dayInLunarPhase);
        // $khmerDayInLunarPhase = str_pad(self::convertToKhmerNumerals($dayInLunarPhase), 2, '0', STR_PAD_LEFT);

        $dayInLunarPhase = $lunarDay <= 15 ? $lunarDay : $lunarDay - 15;

        // Pad the number first (ensures "06" instead of "6")
        $paddedDay = str_pad($dayInLunarPhase, 2, '0', STR_PAD_LEFT);

        // Convert to Khmer numerals
        $khmerDayInLunarPhase = self::convertToKhmerNumerals($paddedDay);

        $dayOfWeek = $khmerDays[$date->format('w')];

        $month = $LunarNewYear[$date->format('n') - 0];
        $year = $nameYear[(($date->format('Y') - 5) % 12)];

        return "{$dayOfWeek} {$khmerDayInLunarPhase}{$lunarPhase} ខែ{$month} {$year} {$khmerYearCycle} ព.ស.{$buddhistYear}";
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
        $validated = $request->validate([
            'stu_code' => 'required|max:50',
            'class_code' => 'required|string|max:50'
        ]);
        $validated['status'] = 1;
        $validated['update_by'] = Auth::id();
        $validated['update_by_date'] = now();
        // $validated['print_khmer_lunar'] =  $request->input('khmer_lunar');
        // $validated['print_date'] =  $request->input('date');

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

            $print_card_id = $existingRecord->id;

            $check_revision = CertStudentPrintCardRevision::where('print_card_id', $print_card_id)
                ->orderBy('id', 'desc')
                ->first();

            if ($check_revision) {
                $check_revision->delete();
            }
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

                            // Remove old image if exists before saving new one
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
                    'message' => 'Images saved successfully.',
                    'updatedStudents' => $updatedStudents,
                ]);
            }

            return response()->json([
                'status' => 400,
                'message' => 'No images found.',
            ]);
        }
    }

    public function uploadMultiplePhoto(Request $request)
    {

        dd("Hello uploadMultiplePhoto");
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
    public function ExcelListClassification(Request $request)
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
            $message = 'Data already exists';
        } else {
            $record_print = CertStudentPrintCardSession::create($validated);
            $status = 200;
            $message = 'Add New successfully!';
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
            $message = 'Updated successfully!';
        } else {
            $status = 404;
            $message = 'Record Not found!';
        }

        return response()->json(['status' => $status, 'data' => $record_print, 'message' => $message]);
    }
    public function showCardTotalStudent(Request $request)
    {
        $class_code = $request->input('class_code');

        $students = StudentModel::getShowCardTotalStudent($class_code);
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
                'expire_date' => $expire_date,
                'print_expire_date' => $print_expire_date,
                'status' => 1,
            ];

            $existingRecord = CertStudentPrintCardExpireClass::where('session_code', $session_code)
                ->where('class_code', $class->code)
                ->where('status', 1)
                ->first();

            if ($existingRecord) {
                //$existingRecord->update($validated);
                $status = 404;
                $message = "Data Already {$level}!";
            } else {
                CertStudentPrintCardExpireClass::create($validated);
                $status = 200;
                $message = "Added successfully for level {$level}!";
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
        $message = '';

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
                $message = "Update success of level {$level}!";
            } else {
                //CertStudentPrintCardExpireClass::create($validated);
                $status = 404;
                $message = "Not fund for level {$level}!";
            }
        }

        return response()->json(['status' => $status, 'data' => $message, 'message' => $message]);
    }

    public function showCardExpireLevel(Request $request)
    {
        $level = $request->input('level');

        $query = Classes::whereNotNull('department_code');

        $query->where('level', $level ?? '');

        $record_level = $query->select('*')
            ->get();

        $exp_yaer = $this->getEducationLevelValue($level);
        $newDate = Carbon::now()->addYears($exp_yaer)->format('Y-m-d');
        return response()->json(array(
            'record_level' => $record_level,
            'record_date' => $newDate,
            'record_exp_year' => self::getKhmerDateCardStudent(new DateTime($newDate)),
        ));
    }


    public function showExpireClass(Request $request)
    {
        $data = $request->all();
        $level_code = $request->input('level_code');
        $class_code = $request->input('class_code');

        $query = CertStudentPrintCardExpireClass::where('status', 1);
        if ($class_code !== 'code_all') {
            $query->where('class_code', $class_code);
        }
        $query->whereHas('class', function ($q) use ($level_code) {
            $q->where('level', $level_code);
        });

        $records = CertStudentPrintCardExpireClass::where('class_code', $data['data_class'])->first();
// 
        $qualification = Classes::where('code', $data['data_class'])->value('level');
        $results = $query->with(['class', 'createdBy:id,name', 'updatedBy:id,name'])->get();
       

        return response()->json([
            'results' => $results,
            'records' => $records,
            'qualification' => $qualification
        ]);
    }

    public function GetDate(Request $request)
    {
        $data = $request->all();

        $records = CertStudentPrintCardSession::first();
        return response()->json(['status' =>'success','records' =>$records]);
    }
}
